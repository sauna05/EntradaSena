<?php

namespace App\Http\Controllers\DbProgramacion;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\Classroom;
use App\Models\DbProgramacion\Cohort as dbProgramacionCohort;
use App\Models\DbProgramacion\CohorTime;
use App\Models\DbProgramacion\Instructor;
use App\Models\DbProgramacion\Person;
use App\Models\DbProgramacion\Program;
use App\Models\DbProgramacion\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// ... (mantén tus imports y namespace)
class CohortController extends Controller
{
    public function indexCohort()
    {
        $instructors = Instructor::with('person')->get();

        $programs = Program::all();
        $cohorts = dbProgramacionCohort::all();
        $towns = Town::all();
        $classroom = Classroom::all();
        $cohortimes = CohorTime::all();

        return view('pages.programming.Admin.Cohort.programming_cohort_index', compact(
            'cohorts',
            'programs',
            'instructors',
            'towns',
            'cohortimes',
            'classroom'
        ));
    }



    public function registerCohort(Request $request)
    {

        $request->validate([
            'number_cohort' => 'required|integer',
            'id_program' => 'required|exists:db_programacion.programs,id',

            'id_time' => 'required|exists:db_programacion.cohort_times,id',

            'id_town' => 'required|exists:db_programacion.towns,id',
            'hours_school_stage' => 'required|integer|min:0',
            'hours_practical_stage' => 'required|integer|min:0',
            'start_date_school_stage' => 'required|date',
            'end_date_school_stage' => 'required|date|after_or_equal:start_date_school_stage',
            'start_date_practical_stage' => 'required|date',
            'end_date_practical_stage' => 'required|date|after_or_equal:start_date_practical_stage',
        ]);



        try {
            dbProgramacionCohort::create([
                'number_cohort' => $request->number_cohort,
                'id_program' => $request->id_program,
                'id_instructor' => $request->id_instructor,
                'id_time' => $request->id_time,
                'id_classroom' => $request->id_classroom,
                'id_town' => $request->id_town,
                'hours_school_stage' => $request->hours_school_stage,
                'hours_practical_stage' => $request->hours_practical_stage,
                'start_date_school_stage' => $request->start_date_school_stage,
                'end_date_school_stage' => $request->end_date_school_stage,
                'start_date_practical_stage' => $request->start_date_practical_stage,
                'end_date_practical_stage' => $request->end_date_practical_stage,
            ]);


            return redirect()->back()->with('success', 'Ficha registrada con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
