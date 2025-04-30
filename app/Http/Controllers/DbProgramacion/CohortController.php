<?php

namespace App\Http\Controllers\DbProgramacion;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\Classroom;
use App\Models\DbProgramacion\CohorTime;
use App\Models\DbProgramacion\Person;
use App\Models\DbProgramacion\Program;
use App\Models\DbProgramacion\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CohortController extends Controller
{
    public function indexCohort()
    {
        // Obtener todos los programas
        $programs = Program::all();
        $towns=Town::all();
        $classroom=Classroom::all();

        // Obtener todas las personas que son instructores
        // Asumo que tienes una relación 'instructors' en Person, pero parece que quieres obtener personas con rol instructor
        // Si quieres obtener personas que son instructores, probablemente debas filtrar por posición o rol.
        // Ejemplo: personas con id_position = 3 (suponiendo que 3 es instructor)
        $instructors = Person::where('id_position', 4)->get();
        $cohortimes=CohorTime::all();

        return view('pages.programming.Admin.Cohort.programming_cohort_index', 
        compact('programs', 'instructors','towns','cohortimes','classroom'));
    }

    public function registerCohort(Request $request)
    {
        // Validar los datos recibidos
        $validator = Validator::make($request->all(), [
            'id_program' => 'required|exists:programs,id',
            'id_instructor' => 'required|exists:people,id',
            'id_time' => 'required|exists:cohortimes,id',
            'id_town' => 'required|exists:towns,id',
            'id_classroom' => 'required|exists:classrooms,id',
            'hours_school_stage' => 'required|integer|min:0',
            'hours_practical_stage' => 'required|integer|min:0',
            'start_date_school_stage' => 'required|date',
            'end_date_school_stage' => 'required|date|after_or_equal:start_date_school_stage',
            'start_date_practical_stage' => 'required|date',
            'end_date_practical_stage' => 'required|date|after_or_equal:start_date_practical_stage',
        ]);

        if ($validator->fails()) {
            // Retorna a la vista anterior con errores y datos viejos
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Error al registrar la ficha. Por favor corrige los errores.');
        }

        try {
            // Crear la ficha (cohort)
            CohorTime::create([
                'program_id' => $request->program_id,
                'instructor_id' => $request->instructor_id,
                'cohortime_id' => $request->cohortime_id,
                'town_id' => $request->town_id,
                'classroom_id' => $request->classroom_id,
                'hours_school_stage' => $request->hours_school_stage,
                'hours_practical_stage' => $request->hours_practical_stage,
                'start_date_school_stage' => $request->start_date_school_stage,
                'end_date_school_stage' => $request->end_date_school_stage,
                'start_date_practical_stage' => $request->start_date_practical_stage,
                'end_date_practical_stage' => $request->end_date_practical_stage,
            ]);

            return redirect()->back()->with('success', 'Ficha registrada con éxito.');
        } catch (\Exception $e) {
            // Manejo de error inesperado
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ocurrió un error inesperado al registrar la ficha.');
        }
    }
}
