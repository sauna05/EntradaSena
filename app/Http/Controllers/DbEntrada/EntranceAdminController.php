<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\DayAvailable;
use App\Models\DbProgramacion\Person;//este es de db_entrada
use App\Models\DbProgramacion\Position;
use App\Models\DbProgramacion\User;
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

        // Obtener todos los resultados (sin paginación)
        $person = $personQuery->get();

        return view('pages.programming.Admin.people.people_index', [
            'person' => $person,
            'positions' => $positions,
            'selectedPosition' => $selectedPosition
        ]);
    }


    public function peopleShow($id){

        $person = Person::with('days_available')->findOrFail($id);

        // $email = DbProgramacionPerson::where('document_number',$person->document_number)->pluck('email');
        return view('pages.programming.Admin.people.people_show',['person'=>$person]);
    }

    public function peopleCreate(){
        $positions = Position::pluck('name','id');
        $days_available = DayAvailable::all();
        $towns = Town::all();
        $specialities = Speciality::all();
        $link_types = LinkType::all();
        $instructor_status = InstructorStatus::all();
        return view('pages.programming.Admin.people.people_create',
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
    DB::beginTransaction();

    try {
        // Validación general
        $request->validate([
            'id_position' => 'required|exists:positions,id',
            'id_town' => 'required|exists:towns,id',
            'document_number' => 'required|unique:people,document_number',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
        ]);

        $position = Position::find($request->id_position);

        if (!$position) {
            return back()->with('error', 'El cargo seleccionado no existe.');
        }

        // Crear persona
        $person = Person::create([
            'id_position'     => $position->id,
            'document_number' => $request->document_number,
            'name'            => $request->name,
            'id_town'         => $request->id_town,
            'email'           => $request->email,
            'address'         => $request->address,
            'phone_number'    => $request->phone_number,
            'start_date'      => $request->start_date,
            'end_date'        => $request->end_date,
        ]);

        // Días disponibles
        $person->days_available()->sync($request->days ?? []);

        // Obtener nombre del cargo en minúscula
        $positionName = strtolower($position->name);

        // Si es aprendiz
        if ($positionName === 'aprendiz') {
            $status = ApprenticeStatus::where('name', 'En Formación')->first();
            Apprentice::create([
                'id_person' => $person->id,
                'id_status' => $status ? $status->id : 1
            ]);
        }

        // Si es instructor
        if ($positionName === 'instructor') {
            $instructorData = $request->validate([
                'id_link_type' => 'required|exists:link_types,id',
                'id_speciality' => 'required|exists:specialities,id',
                'id_instructor_status' => 'required|exists:instructors_status,id',
                'assigned_hours' => 'required|integer|min:1',
                // 'months_contract' => 'required|integer|min:1',
                'hours_day' => 'required|numeric|min:1'
            ], [
                'required' => 'El campo :attribute es obligatorio.',
            ]);

            Instructor::create([
                'id_person'         => $person->id,
                'id_status'         => $instructorData['id_instructor_status'],
                'id_link_type'      => $instructorData['id_link_type'],
                'id_speciality'     => $instructorData['id_speciality'],
                'assigned_hours'    => $instructorData['assigned_hours'],
                // 'months_contract'   => $instructorData['months_contract'],
                'hours_day'         => $instructorData['hours_day'],
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }

        // Crear usuario con rol
        $user = User::create([
            'id_person' => $person->id,
            'user_name' => $person->document_number,
            'password' => bcrypt($person->document_number)
        ]);
        $user->assignRole($position->name);

        DB::commit();
        return redirect()->route('entrance.people.index')->with('message', 'Persona registrada correctamente.');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error al registrar persona: ' . $e->getMessage());
        return back()->with('error', 'Ocurrió un error al registrar la persona.'. $e->getMessage());
    }
}



    public function peopleEdit($id){
        $person = Person::findOrFail($id);
        $positions = Position::all();
        $days_available =  DayAvailable::all();
        return view('pages.programming.Admin.people.people_edit',['person'=>$person,'positions'=>$positions,'days_available'=>$days_available]);
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

        $position_apprentice = Position::where('name', 'Aprendiz')->first();
        $status_apprentice = ApprenticeStatus::where('name', 'En Formacion')->first();

        if (!$position_apprentice || !$status_apprentice) {
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

                    $fecha_inicio = !empty($row['FECHA_INICIO']) ? new \DateTime($row['FECHA_INICIO']) : null;
                    $fecha_fin = !empty($row['FECHA_FINALIZACION']) ? new \DateTime($row['FECHA_FINALIZACION']) : null;

                    if ($fecha_inicio && $fecha_fin && $fecha_fin < $fecha_inicio) {
                        throw new \Exception("La fecha de finalización no puede ser anterior a la de inicio.");
                    }

                    $nombre_completo = trim(($row['NOMBRES'] ?? '') . ' ' . ($row['APELLIDOS'] ?? ''));
                    $town_name = strtolower(trim($row['MUNICIPIO'] ?? ''));
                    $town_id = $towns_dictionary[$town_name] ?? null;

                    $person = Person::create([
                        'document_number' => $document,
                        'id_position' => $position_apprentice->id,
                        'name' => $nombre_completo,
                        'address' => trim($row['DIRECCION'] ?? ''),
                        'phone_number' => trim($row['NUMERO_CELULAR'] ?? ''),
                        'id_town' => $town_id,
                        'email' => trim($row['CORREO'] ?? ''),
                        'start_date' => $fecha_inicio ? $fecha_inicio->format('Y-m-d') : null,
                        'end_date' => $fecha_fin ? $fecha_fin->format('Y-m-d') : null,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    Apprentice::create([
                        'id_person' => $person->id,
                        'id_status' => $status_apprentice->id,
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
