<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
use App\Models\DbEntrada\DayAvailable;
use App\Models\DbEntrada\Person;
use App\Models\DbEntrada\Position;
use App\Models\DbEntrada\User;
use App\Models\DbProgramacion\Apprentice;
use App\Models\DbProgramacion\ApprenticeStatus;
use App\Models\DbProgramacion\Instructor;
use App\Models\DbProgramacion\InstructorStatus;
use App\Models\DbProgramacion\LinkType;
use App\Models\DbProgramacion\Person as DbProgramacionPerson;
use App\Models\DbProgramacion\Position as DbProgramacionPosition;
use App\Models\DbProgramacion\Speciality;
use App\Models\DbProgramacion\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EntranceAdminController extends Controller
{
    public function peopleIndex(Request $request)
    {
        $search = $request->input('search');
        $selectedPosition = $request->input('position'); // Obtener el cargo seleccionado

        // Obtener todos los cargos disponibles
        $positions = Position::all();

        // Construir la consulta de personas
        $personQuery = Person::with('position');

        // Filtrar por nombre, documento o cargo
        if ($search) {
            $personQuery->where(function ($query) use ($search) {
                $query->where('document_number', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            });
        }

        // Filtrar por cargo si se selecciona uno
        if ($selectedPosition) {
            $personQuery->where('id_position', $selectedPosition);
        }

        // Paginación con los resultados filtrados
        $person = $personQuery->paginate(20)->appends(['search' => $search, 'position' => $selectedPosition]);

        return view('pages.entrance.admin.people.people_index', [
            'person' => $person,
            'positions' => $positions,  // Pasar los cargos disponibles a la vista
            'selectedPosition' => $selectedPosition  // Pasar el cargo seleccionado
        ]);
    }


    public function peopleShow($id){
        
        $person = Person::with('days_available')->findOrFail($id);

        // $email = DbProgramacionPerson::where('document_number',$person->document_number)->pluck('email');
        return view('pages.entrance.admin.people.people_show',['person'=>$person]);
    }

    public function peopleCreate(){
        $positions = Position::pluck('name','id');
        $days_available = DayAvailable::all();
        $towns = Town::all();
        $specialities = Speciality::all();
        $link_types = LinkType::all();
        $instructor_status = InstructorStatus::all();
        return view('pages.entrance.admin.people.people_create',
        ['positions'=> $positions,
         'days_available'=>$days_available,
         'towns'=>$towns,
         'specialities' => $specialities,
         'link_types' => $link_types,
         'instructor_status' => $instructor_status
        ]);
    }
        public function peopleStore(Request $request)
        {
            // Validación personalizada
            $request->validate([
                'id_position' => 'required',
                'id_town' => 'required',
                'document_number' => 'required',
                'name' => 'required',
                'phone_number' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'email' => 'required|email',
                'address' => 'required',
            ], [
                'id_position.required' => 'El campo cargo es obligatorio.',
                'id_town.required' => 'El campo municipio es obligatorio.',
                'document_number.required' => 'El campo número de documento es obligatorio.',
                'name.required' => 'El campo nombre es obligatorio.',
                'phone_number.required' => 'El campo número de teléfono es obligatorio.',
                'start_date.required' => 'La fecha de inicio es obligatoria.',
                'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
                'end_date.required' => 'La fecha de finalización es obligatoria.',
                'end_date.date' => 'La fecha de finalización debe ser una fecha válida.',
                'end_date.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',
                'email.required' => 'El correo electrónico es obligatorio.',
                'email.email' => 'Debe ingresar un correo electrónico válido.',
                'address.required' => 'La dirección es obligatoria.',
            ]);

            // Buscar cargo
            $position = Position::where('name', $request->id_position)->first();

            // Validación de persona ya registrada
            if (Person::where('document_number', $request->document_number)->exists()) {
                return redirect()->route('entrance.people.index')->with('message', 'Ya existe una persona en el centro con este número de documento');
            }

            // Crear persona
            $person = Person::create([
                'id_position' => $position->id,
                'name' => $request->name,
                'document_number' => $request->document_number,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);

            // Días disponibles
            $person->days_available()->sync($request->days);

            switch ($request->id_position) {
                case "Aprendiz":
                    if (DbProgramacionPerson::where('document_number', $request->document_number)->exists()) {
                        return redirect()->route('entrance.people.index')->with('message', 'El aprendiz ya está registrado en la programación.');
                    }

                    $personProg = DbProgramacionPerson::create([
                        'document_number' => $request->document_number,
                        'name' => $request->name,
                        'id_position' => $position->id,
                        'id_town' => $request->id_town,
                        'email' => $request->email,
                        'address' => $request->address,
                        'phone_number' => $request->phone_number
                    ]);

                    $apprenticeStatus = ApprenticeStatus::where('name', 'En Formación')->first();

                    Apprentice::create([
                        'id_person' => $personProg->id,
                        'id_status' => $apprenticeStatus->id,
                    ]);
                    break;

                case "Instructor":
                    if (DbProgramacionPerson::where('document_number', $request->document_number)->exists()) {
                        return redirect()->route('entrance.people.index')->with('message', 'El instructor ya está registrado en la programación.');
                    }

                    $instructorData = $request->validate([
                        'id_link_type' => 'required',
                        'id_speciality' => 'required',
                        'id_instructor_status' => 'required',
                        'assigned_hours' => 'required',
                        'months_contract' => 'required',
                        'hours_day' => 'required'
                    ], [
                        'id_link_type.required' => 'El tipo de vinculación es obligatorio.',
                        'id_speciality.required' => 'La especialidad es obligatoria.',
                        'id_instructor_status.required' => 'El estado del instructor es obligatorio.',
                        'assigned_hours.required' => 'Las horas asignadas son obligatorias.',
                        'months_contract.required' => 'Los meses de contrato son obligatorios.',
                        'hours_day.required' => 'Las horas por día son obligatorias.',
                    ]);

                    $personProg = DbProgramacionPerson::create([
                        'id_position' => $position->id,
                        'document_number' => $request->document_number,
                        'name' => $request->name,
                        'id_town' => $request->id_town,
                        'email' => $request->email,
                        'address' => $request->address,
                        'phone_number' => $request->phone_number
                    ]);

                    Instructor::create([
                        'id_person' => $personProg->id,
                        'id_status' => $instructorData['id_instructor_status'],
                        'id_link_type' => $instructorData['id_link_type'],
                        'id_speciality' => $instructorData['id_speciality'],
                        'assigned_hours' => $instructorData['assigned_hours'],
                        'months_contract'  => $instructorData['months_contract'],
                        'hours_day' => $instructorData['hours_day'],
                    ]);
                    break;

                default:
                    return back()->with('error', 'Cargo no válido');
            }

            // Crear usuario
            $user = User::create([
                'id_person' => $person->id,
                'user_name' => $person->document_number,
                'password' => bcrypt($person->document_number)
            ]);
            $user->assignRole($request->id_position);

            return redirect()->route('entrance.people.index')->with('message', 'Persona Registrada Correctamente');
        }


    public function peopleEdit($id){
        $person = Person::findOrFail($id);
        $positions = Position::all();
        $days_available =  DayAvailable::all();
        return view('pages.entrance.admin.people.people_edit',['person'=>$person,'positions'=>$positions,'days_available'=>$days_available]);
    }

    public function peopleUpdate(Request $request, $id){
        $data = $request->validate([
            'id_position' => 'required',
            'name' => 'required',
            'document_number' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        $personToUpdate = Person::findOrFail($id);
        
        $personToUpdate->update([
            'id_position' => $data['id_position'],
            'name' => $data['name'],
            'document_number' => $data['document_number'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);
        $personToUpdate->days_available()->sync($request->days);

            return redirect()->route('entrance.people.index')->with('message', 'Datos actualizados exitosamente!');

    }

    public function peopleDelete($id){
        $person = Person::findOrFail($id);

        if($person){
            $person->days_available()->detach();
            if($person->user){
                $person->user->delete();
            }
            $person->delete();
            return redirect()->route('entrance.people.index')->with('message', 'Persona eliminada correctamente');

        }

        return redirect()->route('entrance.people.index')->with('message', 'Persona no encontrada');

    }




    public function storePeopleExcel(Request $request)
    {
        set_time_limit(600);
        ini_set('memory_limit', '2048M');

        $id_position_apprentice_entrance= Position::where('name','Aprendiz')->first();
        $id_position_apprentice_programming = DbProgramacionPosition::where('name', 'Aprendiz')->first();
        $id_status_apprentice = ApprenticeStatus::where('name','En Formacion')->first();
        $towns_dictionary = Town::pluck('id', 'name')
            ->mapWithKeys(fn($id, $name) => [strtolower($name) => $id])
            ->toArray();

        try {
            Log::info('Iniciando importación de personas...');
            // Validación de columnas del excel
            $data = $request->validate([
                'people' => 'required|array',
                'people.*.NUMERO_DOCUMENTO' => 'required|max:13',
                'people.*.NOMBRES' => 'nullable|string',
                'people.*.APELLIDOS' => 'nullable|string',
                'people.*.FECHA_INICIO' => 'nullable|date',
                'people.*.FECHA_FINALIZACION' => 'nullable|date|after_or_equal:people.*.FECHA_INICIO',
                'people.*.MUNICIPIO' => 'nullable|string',
                'people.*.NUMERO_CELULAR' => 'nullable|string',
                'people.*.CORREO' => 'nullable|string',
                'people.*.DIRECCION' => 'nullable|string',
            ]);

            Log::info('Total registros recibidos:', ['cantidad' => count($data['people'])]);

            // Eliminar duplicados dentro del archivo Excel
            $people = collect($data['people'])->unique('NUMERO_DOCUMENTO')->values()->toArray();
            Log::info('Personas únicas en el archivo:', ['cantidad' => count($people)]);

            // Obtener los documentos que ya están en la BD
            $documentosExistentes = Person::pluck('document_number')->flip();
            Log::info('Total documentos en la BD:', ['cantidad' => count($documentosExistentes)]);

            $nuevosRegistros = 0;
            $errores = [];

            DB::beginTransaction();

            foreach ($people as $row) {
                try {
                    $town_id = null;
                    // Si el documento ya existe en db, lo ignoramos
                    if (isset($documentosExistentes[$row['NUMERO_DOCUMENTO']])) {
                        continue;
                    }

                    // Crear persona em db_personas - people
                    $person = Person::create([
                        'document_number' => $row['NUMERO_DOCUMENTO'],
                        'id_position' => $id_position_apprentice_entrance->id,
                        'name' => trim(($row['NOMBRES'] ?? '') . " " . ($row['APELLIDOS'] ?? '')),
                        'start_date' => $row['FECHA_INICIO'] ?? null,
                        'end_date' => $row['FECHA_FINALIZACION'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    $days = [1,2,3,4,5];
                    $person->days_available()->sync($days);

                    // Crear usuario vinculado en db_personas
                    User::create([
                        'id_person' => $person->id,
                        'user_name' => $person->document_number,
                        'password' => bcrypt($person->document_number),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    //Verificaion del municipio con un array de municipios(towns) creado arriba

                    $town_name = strtolower($row['MUNICIPIO']);
                    
                    if(isset($towns_dictionary[$town_name])){
                        $town_id = $towns_dictionary[$town_name];
                    }

                   $personProg = DbProgramacionPerson::create([
                        'document_number' => $row['NUMERO_DOCUMENTO'],
                        'id_position' => $id_position_apprentice_programming->id,
                        'name' => trim(($row['NOMBRES'] ?? '') . " " . ($row['APELLIDOS'] ?? '')),
                        'address' => trim($row['CORREO'] ?? ''),
                        'phone_number' => trim($row['NUMERO_CELULAR'] ?? ''),
                        'id_town' => $town_id ?? null,
                        'email' => trim($row['CORREO']),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);


                    //Se registra en la tabla aprendices
                    Apprentice::create([
                        'id_person' => $personProg->id,
                        'id_status' => $id_status_apprentice->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);


                    $nuevosRegistros++;
                    Log::info('Persona registrada:', ['document' => $person->document_number, 'name' => $person->name]);

                    // Agregar el documento al array de existentes para evitar futuros duplicados
                    $documentosExistentes[$row['NUMERO_DOCUMENTO']] = true;
                } catch (\Exception $e) {
                    // Guardar error sin detener el proceso
                    $errores[] = ['document' => $row['NUMERO_DOCUMENTO'], 'error' => $e->getMessage()];
                    Log::error('Error con el documento ' . $row['NUMERO_DOCUMENTO'] . ': ' . $e->getMessage());
                }
            }

            DB::commit();
            Log::info('Importación finalizada.', ['total_registrados' => $nuevosRegistros, 'total_errores' => count($errores)]);

            return response()->json([
                'success' => true,
                'message' => 'Importación completada',
                'registrados' => $nuevosRegistros,
                'errores' => $errores
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en la importación: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error en la importación',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
