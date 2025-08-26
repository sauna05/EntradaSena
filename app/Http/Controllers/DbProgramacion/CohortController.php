<?php

namespace App\Http\Controllers\DbProgramacion;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\Classroom;
use App\Models\DbProgramacion\Cohort;
use App\Models\DbProgramacion\Programming as dbProgramacionCohort;
use App\Models\DbProgramacion\CohorTime;
use App\Models\DbProgramacion\Competencies;
use App\Models\DbProgramacion\Instructor;
use App\Models\DbProgramacion\Person;
use App\Models\DbProgramacion\Program;
use App\Models\DbProgramacion\Speciality;
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
        $towns = Town::all();
        $classroom = Classroom::all();
        $cohortimes = CohorTime::all();

        // Obtener cohortes con relaciones necesarias
        $cohorts = Cohort::with(['program', 'cohortime', 'town'])
            ->get()
            ->each(function ($cohort) {
                // Determinar si la ficha está activa o inactiva
                $cohort->estado = $cohort->end_date > now() ? 'Activa' : 'Inactiva';
                $cohort->end_date_formatted = optional($cohort->end_date)->format('Y-m-d');
            });

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
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'enrolled_quantity' => 'required|integer|min:1',
            ], [
                'number_cohort.unique' => 'El número de ficha ya existe en el sistema.',
                'end_date.after_or_equal' => 'La fecha de fin debe ser posterior o igual a la fecha de inicio.',
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
                $cohort->start_date = $request->start_date;
                $cohort->end_date = $request->end_date;
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

    public function Listcompetencies(Request $request, $cohortId)
    {
        // Obtener la ficha específica con relaciones
        $cohort = Cohort::with(['program', 'cohortime', 'town'])->findOrFail($cohortId);

        // Todas las especialidades (para selects)
        $especialidad = Speciality::all();

        // Todas las competencias disponibles
        $competencies = Competencies::orderBy('created_at', 'desc')->get();

        // Competencias ya asignadas a la ficha
        $assignedCompetencies = $cohort->competences()->get();

        return view('pages.programming.Admin.Competencies.competencies_index',
            compact('competencies', 'especialidad', 'cohort', 'assignedCompetencies'));
    }



    public function competenciesAdd_store(Request $request)
    {
        $request->validate([
            'cohort_id'      => 'required|exists:db_programacion.cohorts,id',
            'speciality_id'  => 'required|exists:db_programacion.specialities,id',
            'name'           => 'required|string|max:255',
            'duration_hours' => 'required|integer|min:1',
        ]);

        try {
            DB::connection('db_programacion')->beginTransaction();

            // 1. Crear competencia
            $competencia = Competencies::create([
                'speciality_id'  => $request->speciality_id,
                'name'           => $request->name,
                'duration_hours' => $request->duration_hours,
            ]);

            // 2. Buscar ficha y asignar competencia
            $ficha = Cohort::findOrFail($request->cohort_id);

            $ficha->competences()->attach($competencia->id, [
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::connection('db_programacion')->commit();

            return redirect()->back()->with('success', '✅ Competencia creada y asignada a la ficha correctamente.');
        } catch (\Exception $e) {
            DB::connection('db_programacion')->rollBack();
            return redirect()->back()->with('error', '❌ Error al crear y asignar la competencia: ' . $e->getMessage());
        }
    }





}

