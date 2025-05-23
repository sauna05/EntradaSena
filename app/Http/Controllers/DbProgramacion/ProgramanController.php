<?php

namespace App\Http\Controllers\DbProgramacion;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\Apprentice;
use App\Models\DbProgramacion\Cohort;
use App\Models\DbProgramacion\Competencies;
use App\Models\DbProgramacion\Instructor;
use App\Models\DbProgramacion\Program as dbProgramacionPrograman;
use App\Models\DbProgramacion\Program_Level;
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
}
