<?php

namespace App\Http\Controllers\DbProgramacion;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\Classroom;
use App\Models\DbProgramacion\Cohort;
use App\Models\DbProgramacion\Programming as dbProgramacionCohort;
use App\Models\DbProgramacion\CohorTime;
use App\Models\DbProgramacion\Instructor;
use App\Models\DbProgramacion\Person;
use App\Models\DbProgramacion\Program;
use App\Models\DbProgramacion\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CohortController extends Controller
{
    public function indexCohort()
    {
        $instructors = Instructor::with('person')->get();
        $programs = Program::all();

        // Obtener cohortes con relaciones necesarias y calcular horas
        $cohorts = Cohort::with(['program', 'cohortime', 'town'])
            ->withSum([
                'programmings as horas_cumplidas' => function ($query) {
                    $query->whereIn('status', ['finalizada_evaluada', 'finalizada_no_evaluada']);
                }
            ], 'hours_duration')
            ->withSum('programmings as horas_programadas', 'hours_duration')
            ->get()
            ->each(function ($cohort) {
                // Calcular horas pendientes (horas totales - horas programadas)
                $cohort->horas_pendientes = max($cohort->hours_school_stage - $cohort->horas_programadas, 0);

                // Calcular porcentaje de avance (horas cumplidas / horas totales)
                $cohort->porcentaje_avance = $cohort->hours_school_stage > 0
                    ? round(($cohort->horas_cumplidas / $cohort->hours_school_stage) * 100, 2)
                    : 0;

                // Calcular porcentaje de programación (horas programadas / horas totales)
                $cohort->porcentaje_programado = $cohort->hours_school_stage > 0
                    ? round(($cohort->horas_programadas / $cohort->hours_school_stage) * 100, 2)
                    : 0;
            });

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
        $validator = Validator::make($request->all(), [
            'number_cohort' => 'required|integer|unique:db_programacion.cohorts,number_cohort',
            'id_program' => 'required|exists:db_programacion.programs,id',
            'id_time' => 'required|exists:db_programacion.cohort_times,id',
            'id_town' => 'required|exists:db_programacion.towns,id',
            'hours_school_stage' => 'required|integer|min:1',
            'hours_practical_stage' => 'required|integer|min:0',
            'start_date_school_stage' => 'required|date',
            'end_date_school_stage' => 'required|date|after_or_equal:start_date_school_stage',
            'start_date_practical_stage' => 'required|date|after_or_equal:end_date_school_stage',
            'end_date_practical_stage' => 'required|date|after_or_equal:start_date_practical_stage',
            'enrolled_quantity' => 'required|integer|min:1',
        ], [
            'number_cohort.unique' => 'El número de ficha ya existe en el sistema.',
            'end_date_school_stage.after_or_equal' => 'La fecha de fin de etapa escolar debe ser posterior o igual a la fecha de inicio.',
            'start_date_practical_stage.after_or_equal' => 'La fecha de inicio de etapa práctica debe ser posterior a la fecha de fin de etapa escolar.',
            'end_date_practical_stage.after_or_equal' => 'La fecha de fin de etapa práctica debe ser posterior o igual a la fecha de inicio.',
            'hours_school_stage.min' => 'Las horas de etapa escolar deben ser al menos 1.',
            'enrolled_quantity.min' => 'Debe haber al menos 1 matriculado.'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $cohort = new Cohort();
            $cohort->number_cohort = $request->number_cohort;
            $cohort->id_program = $request->id_program;
            $cohort->id_time = $request->id_time;
            $cohort->id_town = $request->id_town;
            $cohort->hours_school_stage = $request->hours_school_stage;
            $cohort->hours_practical_stage = $request->hours_practical_stage;
            $cohort->start_date_school_stage = $request->start_date_school_stage;
            $cohort->end_date_school_stage = $request->end_date_school_stage;
            $cohort->start_date_practical_stage = $request->start_date_practical_stage;
            $cohort->end_date_practical_stage = $request->end_date_practical_stage;
            $cohort->enrolled_quantity = $request->enrolled_quantity;
            $cohort->save();

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Ficha registrada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Error al registrar la ficha: ' . $e->getMessage())
                ->withInput();
        }
    }
}

