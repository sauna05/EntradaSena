<?php

namespace App\Http\Controllers\DbProgramacion;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\Apprentice;
use App\Models\DbProgramacion\Classroom;
use App\Models\DbProgramacion\Cohort;
use App\Models\DbProgramacion\Competencies;
use App\Models\DbProgramacion\Day;
use App\Models\DbProgramacion\Instructor;
use App\Models\DbProgramacion\Program as dbProgramacionPrograman;
use App\Models\DbProgramacion\Program_Level;
use App\Models\DbProgramacion\Programming;
use Exception;
use Illuminate\Http\Request;

class ProgramanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexPrograman()
    {
        //
        $programan_level = Program_Level::all();
        return view('pages.programming.Admin.programan.programan_Add', compact('programan_level'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_cohort(Request $request)
    {
        // Validación de datos
        $request->validate([
            'id_level' => 'required|exists:db_programacion.program_level,id',
            'program_code' => 'required|string|max:255',
            'program_version' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        // Opción 1: guardar usando create (requiere definir fillable en el modelo)
        dbProgramacionPrograman::create([
            'id_level' => $request->id_level,
            'program_code' => $request->program_code,
            'program_version' => $request->program_version,
            'name' => $request->name,
        ]);

        // Opción 2 (comentada): guardar usando new y save()
        /*
    $program = new dbProgramacionPrograman();
    $program->id_level = $request->id_level;
    $program->program_code = $request->program_code;
    $program->program_version = $request->program_version;
    $program->name = $request->name;
    $program->save();
    */

        return redirect()->back()->with('success', 'Programa registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
   public function asignarCompetences_index()
    {
        $programas = dbProgramacionPrograman::all(); // Lista de programas

        // Competencias no asignadas a ningún programa
        $competencias = Competencies::whereDoesntHave('programs')->get();

        return view('pages.programming.Admin.Competencies.competencies_add_programan', compact('programas', 'competencias'));
    }

    //metodo para la vista de agregar competencia al perfil de instructor
    public function asignarCompetences_index_instructor()
    {
        $instructors = Instructor::with('person')->get(); // Lista de programas

        // Competencias no asignadas a ningún programa
        $competencias = Competencies::whereDoesntHave('instructors')->get();

        return view('pages.programming.Admin.programming_instructor.programming_add_competences_profiles', compact('instructors', 'competencias'));
    }






    public function competenciesAdd_store(Request $request)
    {
        $request->validate([
            'programa_id' => 'required|exists:db_programacion.programs,id',
            'competencias' => 'required|array',
            'competencias.*' => 'exists:db_programacion.competencies,id',
        ]);

        $programa = dbProgramacionPrograman::findOrFail($request->programa_id);

        // Solo competencias que no estén ya asociadas
        $competenciasValidas = Competencies::whereIn('id', $request->competencias)
            ->whereDoesntHave('programs') // evita duplicados
            ->pluck('id')
            ->toArray();

        if (count($competenciasValidas) === 0) {
            return redirect()->back()->with('error', 'Las competencias seleccionadas ya están asignadas a un programa.');
        }

        // Asignar
        $programa->competencies()->attach($competenciasValidas);

        return redirect()->back()->with('success', 'Competencias asignadas correctamente al programa.');
    }


    //asignar competencias a los perfiles de instructor registrar
    public function competenciesAdd_store_profile_instructor(Request $request)
    {
        $request->validate([
            'instructor_id' => 'required|exists:db_programacion.instructors,id',
            'competencias' => 'required|array',
            'competencias.*' => 'exists:db_programacion.competencies,id',
        ]);

        $instructor = Instructor::findOrFail($request->instructor_id);

        // Filtrar competencias no asignadas previamente a este instructor
        $competenciasNuevas = array_filter($request->competencias, function ($competenciaId) use ($instructor) {
            return !$instructor->competencies->contains($competenciaId);
        });

        if (empty($competenciasNuevas)) {
            return redirect()->back()->with('error', 'Las competencias seleccionadas ya están asignadas al instructor.');
        }

        $instructor->competencies()->attach($competenciasNuevas);

        return redirect()->back()->with('success', 'Competencias asignadas correctamente al perfil del instructor.');
    }






    //metodos que permite asignar aprenices a sus fichas correspondientes
    public function asignarAprendiz_index()
    {
        $cohorts = Cohort::all();

        // Aprendices que NO están en ninguna ficha
        $aprentices = Apprentice::whereDoesntHave('cohorts')->with('person')->get();

        return view('pages.programming.Admin.Cohort.programming_asignarApprendices', compact('cohorts', 'aprentices'));
    }


    public function asignarAprendiz_Add(Request $request)
    {
        $request->validate([
            'ficha_id' => 'required|exists:db_programacion.cohorts,id',
            'aprendices' => 'required|array',
            'aprendices.*' => 'exists:db_programacion.apprentices,id',
        ]);

        $cohort = Cohort::findOrFail($request->ficha_id);

        // Filtrar solo los aprendices que NO están asignados a ninguna otra ficha
        $apprenticesValidos = Apprentice::whereIn('id', $request->aprendices)
            ->whereDoesntHave('cohorts') // Solo los que no están en ninguna ficha
            ->pluck('id')
            ->toArray();

        if (count($apprenticesValidos) === 0) {
            return redirect()->back()->with('error', 'Los aprendices seleccionados ya están asignados a una ficha.');
        }

        // Asignar los aprendices válidos a la ficha
        $cohort->apprentices()->attach($apprenticesValidos);

        return redirect()->back()->with('success', 'Aprendices asignados correctamente.');
    }


    public function list_competencias_program()
    {
        $query = dbProgramacionPrograman::with('competencies')
            ->whereHas('competencies'); // solo programas con competencias

        if (request('programa_id')) {
            $query->where('id', request('programa_id'));
        }

        $programas = $query->get();

        return view('pages.programming.Admin.programan.competencies_program_index', compact('programas'));
    }



    public function ListAprenticesxcohorts(Request $request)
    {
            $comboFicha = $request->input('combo_ficha');

            // Obtenemos todos los aprendices con sus fichas y programas
            $aprendices = Apprentice::with(['person', 'cohorts.program'])
                ->whereHas('cohorts') // Solo los que tienen fichas asignadas
                ->get();

            $resultado = [];

            foreach ($aprendices as $apprentice) {
                foreach ($apprentice->cohorts as $cohort) {
                    if ($comboFicha && $cohort->id != $comboFicha) {
                        continue; // Si hay filtro y no coincide, lo ignoramos
                    }

                    $resultado[] = [
                        'person_id'       => $apprentice->person->id,
                        'name'            => $apprentice->person->name,
                        'document_number' => $apprentice->person->document_number,
                        'email'           => $apprentice->person->email,
                        'apprentice_id'   => $apprentice->id,
                        'cohort_id'       => $cohort->id,
                        'start_date_school_stage' => $cohort->start_date_school_stage,
                        'end_date_school_stage'   => $cohort->end_date_school_stage,
                        'start_date_practical_stage' => $cohort->start_date_practical_stage,
                        'end_date_practical_stage'   => $cohort->end_date_practical_stage,
                        'cohort_name'     => $cohort->number_cohort,
                        'nombre_programa' => $cohort->program->name ?? 'Sin programa',
                    ];
                }
            }

            // Obtener listado de fichas + programa para el filtro
            $fichas = Cohort::with('program')
                ->select('id', 'number_cohort', 'id_program')
                ->get()
                ->map(function ($cohort) {
                    return [
                        'id' => $cohort->id,
                        'ficha' => $cohort->number_cohort,
                        'programa' => $cohort->program->name ?? 'Sin programa',
                    ];
                });

            return view('pages.programming.Admin.Apprentices.apprentice_list', [
                'apprentices' => $resultado,
                'fichas' => $fichas
            ]);
        }


        //metodo para gestion de competencias

        public function Listcompetencies()
        {
            $competencies = Competencies::all();
            return view('pages.programming.Admin.Competencies.competencies_index', compact('competencies'));
        }

        // Guardar nueva competencia
        public function competencies_store(Request $request)
        {
            // Validar datos
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'duration_hours' => 'required|integer|min:1',
            ]);

            // Crear y guardar nueva competencia
            Competencies::create($validated);

            // Redirigir con mensaje de éxito
            return redirect()->back()->with('success', 'Competencia registrada correctamente.');
        }

        public function ambientes_index(){

            return view('pages.programming.Admin.Ambientes.ambientes_index');
        }

    //metodo de controlador para listar  los instructores que estan registrados

    public function instructores_index()
    {
        $instructores = Instructor::with(['person', 'speciality'])->get();


        return view('pages.programming.Admin.programming_instructor.programming_instructor_index', compact('instructores'));
    }

   public function registerProgramming_index()
    {
        return view('pages.programming.Admin.programming_instructor.instructor_add_programming', [
            'instructors' => Instructor::with(['person', 'competencies'])->get(),
            'cohorts' => Cohort::all(),
            'ambientes' => Classroom::all(),
            'competencias' => Competencies::all(), // Pasa todas las competencias
        ]);
    }








    public function programming_index()
    {
        try {
            $programaciones = Programming::with([
                'instructor.person',  // Relación belongsTo
                'cohort.program',     // Asumiendo que Cohort tiene relación con Program
                'competencie',        // O mejor renombrar a 'competence'
                'classroom',
                'days'                // Añadir si necesitas los días
            ])->get();

            return view(
                'pages.programming.Admin.programming_instructor.programming_programming_index',
                compact('programaciones')
            );
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Error al listar las programaciones: ' . $ex->getMessage());
        }
    }


    //metodo para registrar programacion

  public function register_programmig(Request $request)
    {
        try {
            // Validación de datos
            $validated = $request->validate([
                'instructor_id' => 'required|exists:db_programacion.instructors,id',
                'ficha_id' => 'required|exists:db_programacion.cohorts,id',
                'competencia_id' => 'required|exists:db_programacion.competencies,id',
                'ambiente_id' => 'required|exists:db_programacion.classrooms,id',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
                'hora_inicio' => 'required',
                'hora_fin' => 'required',
                'horas_dia' => 'required|integer|min:1|max:8',
                'total_horas' => 'required|integer|min:1',
                'dias' => 'required|array',
                'dias.*' => 'string|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
            ]);

            // Crear la programación
            $programming = Programming::create([
                'id_cohort' => $validated['ficha_id'],
                'id_instructor' => $validated['instructor_id'],
                'id_competencie' => $validated['competencia_id'],
                'id_classroom' => $validated['ambiente_id'],
                'hours_duration' => $validated['total_horas'],
                'scheduled_hours' => $validated['horas_dia'] * count($validated['dias']),
                'iniciada' => false,
                'start_date' => $validated['fecha_inicio'],
                'end_date' => $validated['fecha_fin'],
                'start_time' => $validated['hora_inicio'],
                'end_time' => $validated['hora_fin'],
            ]);

            // Obtener IDs de los días seleccionados
            $diasSeleccionados = Day::whereIn('name', $validated['dias'])->pluck('id')->toArray();

            // Asociar los días a la programación (se guardan en la tabla pivote)
            $programming->days()->sync($diasSeleccionados);

            return redirect()->back()->with('success', 'Programación registrada correctamente');

        } catch (Exception $e) {
            // Captura cualquier error y muestra un mensaje
            return redirect()->back()->with('error', 'Error al registrar la programación: ' . $e->getMessage());
        }
    }
}
