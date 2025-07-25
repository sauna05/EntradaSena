<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
use App\Models\DbEntrada\DayAvailable;
use App\Models\DbEntrada\Person;//este es de db_entrada
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
        DB::beginTransaction(); // Transacción para db_entrada

        try {
            // Validación general
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
            ]);

            // Buscar cargo
            $position = Position::find($request->id_position);

            if (!$position) {
                return back()->with('error', 'El cargo seleccionado no existe.');
            }

            // Verificar si ya existe persona en db_entrada
            if (Person::where('document_number', $request->document_number)->exists()) {
                return redirect()->route('entrance.people.index')->with('message', 'Ya existe una persona en el centro con este número de documento');
            }

            // Crear persona en db_entrada
            $person = Person::create([
                'id_position' => $position->id,
                'name' => $request->name,
                'document_number' => $request->document_number,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);

            $person->days_available()->sync($request->days ?? []);

            // Transacción para db_programacion
            DB::connection('db_programacion')->beginTransaction();

            try {
                // Validar si ya existe en db_programacion
                if (DbProgramacionPerson::where('document_number', $request->document_number)->exists()) {
                    return redirect()->route('entrance.people.index')->with('succes', 'Esta persona ya está registrada en la programación.');
                }

                // Crear persona en db_programacion
                $personProg = DbProgramacionPerson::create([
                    'id_position' => $position->id,
                    'document_number' => $request->document_number,
                    'name' => $request->name,
                    'id_town' => $request->id_town,
                    'email' => $request->email,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number
                ]);

                // Lógica según cargo
                switch ($position->name) {
                    case 'Aprendiz':
                        $apprenticeStatus = ApprenticeStatus::where('name', 'En Formación')->first();

                        Apprentice::create([
                            'id_person' => $personProg->id,
                            'id_status' => $apprenticeStatus ? $apprenticeStatus->id : 1,
                        ]);
                        break;

                    case 'Instructor':
                        // Validaciones específicas
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

                        Instructor::create([
                            'id_person' => $personProg->id,
                            'id_status' => $instructorData['id_instructor_status'],
                            'id_link_type' => $instructorData['id_link_type'],
                            'id_speciality' => $instructorData['id_speciality'],
                            'assigned_hours' => $instructorData['assigned_hours'],
                            'months_contract' => $instructorData['months_contract'],
                            'hours_day' => $instructorData['hours_day'],
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                        break;

                    default:
                        DB::rollBack();
                        DB::connection('db_programacion')->rollBack();
                        return back()->with('error', 'Cargo no válido.');
                }

                DB::connection('db_programacion')->commit();
            } catch (\Exception $e) {
                DB::connection('db_programacion')->rollBack();
                Log::error('Error al registrar en db_programacion: ' . $e->getMessage());
                return back()->with('error', 'Error al registrar datos en la programación.');
            }

            // Crear usuario (en db_entrada)
            $user = User::create([
                'id_person' => $person->id,
                'user_name' => $person->document_number,
                'password' => bcrypt($person->document_number)
            ]);
            $user->assignRole($position->name);

            DB::commit(); // Finalizar transacción principal

            return redirect()->route('entrance.people.index')->with('message', 'Persona registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error general al registrar persona: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al registrar la persona.');
        }
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

        $id_position_apprentice_entrance = Position::where('name', 'Aprendiz')->first();
        $id_position_apprentice_programming = DbProgramacionPosition::where('name', 'Aprendiz')->first();
        $id_status_apprentice = ApprenticeStatus::where('name', 'En Formacion')->first();

        if (!$id_position_apprentice_entrance || !$id_position_apprentice_programming || !$id_status_apprentice) {
            return response()->json(['success' => false, 'message' => 'Datos de configuración faltantes'], 400);
        }

        $towns_dictionary = Town::pluck('id', 'name')
            ->mapWithKeys(fn($id, $name) => [strtolower(trim($name)) => $id])
            ->toArray();

        try {
            Log::info('Iniciando importación de personas...');

            $data = $request->validate([
                'people' => 'required|array',
                'people.*.NUMERO_DOCUMENTO' => 'required|max:13',
                'people.*.NOMBRES' => 'nullable|string',
                'people.*.APELLIDOS' => 'nullable|string',
                'people.*.FECHA_INICIO' => 'nullable|date',
                'people.*.FECHA_FINALIZACION' => 'nullable|date',
                'people.*.MUNICIPIO' => 'nullable|string',
                'people.*.NUMERO_CELULAR' => 'nullable|string',
                'people.*.CORREO' => 'nullable|string',
                'people.*.DIRECCION' => 'nullable|string',
            ]);

            $people = collect($data['people'])->unique('NUMERO_DOCUMENTO')->values()->toArray();
            Log::info('Total registros únicos:', ['cantidad' => count($people)]);

            $documentosExistentes = Person::pluck('document_number')->flip();

            $nuevosRegistros = 0;
            $errores = [];

            DB::beginTransaction();

            foreach ($people as $row) {
                try {
                    $document = trim($row['NUMERO_DOCUMENTO']);

                    if (isset($documentosExistentes[$document])) continue;

                    // Validar fecha final >= fecha inicio
                    $fecha_inicio = !empty($row['FECHA_INICIO']) ? new \DateTime($row['FECHA_INICIO']) : null;
                    $fecha_fin = !empty($row['FECHA_FINALIZACION']) ? new \DateTime($row['FECHA_FINALIZACION']) : null;

                    if ($fecha_inicio && $fecha_fin && $fecha_fin < $fecha_inicio) {
                        throw new \Exception("La fecha de finalización no puede ser anterior a la de inicio.");
                    }

                    $nombre_completo = trim(($row['NOMBRES'] ?? '') . ' ' . ($row['APELLIDOS'] ?? ''));

                    $person = Person::create([
                        'document_number' => $document,
                        'id_position' => $id_position_apprentice_entrance->id,
                        'name' => $nombre_completo,
                        'start_date' => $fecha_inicio ? $fecha_inicio->format('Y-m-d') : null,
                        'end_date' => $fecha_fin ? $fecha_fin->format('Y-m-d') : null,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    $person->days_available()->sync([1, 2, 3, 4, 5]);

                    // Crear usuario solo si no existe
                    if (!User::where('user_name', $document)->exists()) {
                        User::create([
                            'id_person' => $person->id,
                            'user_name' => $document,
                            'password' => bcrypt($document),
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }

                    $town_name = strtolower(trim($row['MUNICIPIO'] ?? ''));
                    $town_id = $towns_dictionary[$town_name] ?? null;

                    $personProg = DbProgramacionPerson::create([
                        'document_number' => $document,
                        'id_position' => $id_position_apprentice_programming->id,
                        'name' => $nombre_completo,
                        'address' => trim($row['DIRECCION'] ?? ''),
                        'phone_number' => trim($row['NUMERO_CELULAR'] ?? ''),
                        'id_town' => $town_id,
                        'email' => trim($row['CORREO'] ?? ''),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    Apprentice::create([
                        'id_person' => $personProg->id,
                        'id_status' => $id_status_apprentice->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    $documentosExistentes[$document] = true;
                    $nuevosRegistros++;

                    Log::info('Persona registrada correctamente', ['documento' => $document]);
                } catch (\Exception $e) {
                    $errores[] = ['documento' => $row['NUMERO_DOCUMENTO'], 'error' => $e->getMessage()];
                    Log::error('Error con documento ' . $row['NUMERO_DOCUMENTO'] . ': ' . $e->getMessage());
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Importación completada',
                'registrados' => $nuevosRegistros,
                'errores' => $errores
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error general en la importación: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error en la importación',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
