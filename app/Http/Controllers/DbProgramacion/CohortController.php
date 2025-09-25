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
use App\Models\DbProgramacion\Programming;
use App\Models\DbProgramacion\Speciality;
use App\Models\DbProgramacion\Town;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CohortController extends Controller
{
    public function indexCohort(Request $request)
    {
        // Traer de la vista la variable de búsqueda 'search'
        $ficha_busqueda = $request->input('search');

        $instructors = Instructor::with('person')->get();
        $programs    = Program::all();
        $towns       = Town::all();
        $classroom   = Classroom::all();
        $cohortimes  = CohorTime::all();

        // Consulta base con las relaciones necesarias
        $cohorts = Cohort::with(['program', 'cohortime', 'town'])
            ->when($ficha_busqueda, function ($query, $ficha_busqueda) {
                // Filtra por el campo number_cohort (usa LIKE para búsquedas parciales)
                $query->where('number_cohort', 'LIKE', "%{$ficha_busqueda}%");
            })
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

    public function delete_cohort($id)
    {
        try {
            // Buscar la cohorte por ID
            $cohort = Cohort::findOrFail($id);

            // Verificar que la fecha de finalización sea menor a la actual (ficha inactiva)
            if ($cohort->end_date > now()) {
                return redirect()
                    ->back()
                    ->with('error', 'No se puede eliminar una ficha activa. Solo se pueden eliminar fichas inactivas.');
            }

            // Eliminar la cohorte
            $cohort->delete();

            return redirect()
                ->back()
                ->with('success', 'Ficha eliminada exitosamente.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()
                ->back()
                ->with('error', 'La ficha no existe.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error al eliminar la ficha: ' . $e->getMessage());
        }
    }



    //  1. Listar competencias y programaciones de la ficha
    public function Listcompetencies(Request $request, $cohortId)
    {
        $cohort = Cohort::with(['program', 'cohortime', 'town'])->findOrFail($cohortId);
        $especialidad = Speciality::all();

        $assignedCompetencies = $cohort->competences()->get();

        $programaciones = Programming::with([
            'instructor.person',
            'cohort.program',
            'competencie',
            'classroom',
            'days'
        ])
            ->where('id_cohort', $cohortId)
            ->get();

        // Estados - CORREGIDO: Guardar en la base de datos
        $now = Carbon::now();
        foreach ($programaciones as $prog) {
            $startDate = Carbon::parse($prog->start_date);
            $endDate   = Carbon::parse($prog->end_date);

            if ($now->lt($startDate)) {
                $newStatus = 'pendiente';
            } elseif ($now->between($startDate, $endDate)) {
                $newStatus = 'en_ejecucion';
            } else {
                $newStatus = $prog->evaluated
                    ? 'finalizada_evaluada'
                    : 'finalizada_no_evaluada';
            }

            // 🔥 ACTUALIZAR EN BASE DE DATOS si el estado cambió
            if ($prog->status !== $newStatus) {
                $prog->status = $newStatus;
                $prog->save();
            }
        }

        // 🔥 RECARGAR las programaciones para obtener los estados actualizados
        $programaciones = Programming::with([
            'instructor.person',
            'cohort.program',
            'competencie',
            'classroom',
            'days'
        ])
            ->where('id_cohort', $cohortId)
            ->get();

        $ultimasProgramaciones = Programming::selectRaw('MAX(id) as id')
            ->where('id_cohort', $cohortId)
            ->groupBy('id_competencie')
            ->pluck('id')
            ->toArray();

        $otherCohorts = Cohort::with('competences')
            ->where('id_program', $cohort->id_program)
            ->where('id', '!=', $cohortId)
            ->get();

        $otherCohortsData = $otherCohorts->map(function ($c) {
            return [
                'id' => $c->id,
                'number_cohort' => $c->number_cohort,
                'start_date' => $c->start_date,
                'end_date' => $c->end_date,
                'competences' => $c->competences->map(function ($cp) {
                    return [
                        'id' => $cp->id,
                        'name' => $cp->name,
                        'hours' => $cp->duration_hours,
                    ];
                })->values()->all()
            ];
        })->values()->all();

        return view('pages.programming.Admin.Competencies.competencies_index', compact(
            'especialidad',
            'cohort',
            'assignedCompetencies',
            'ultimasProgramaciones',
            'programaciones',
            'otherCohortsData'
        ));
    }   







    //  2. Registrar una NUEVA competencia y asignarla a la ficha
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

            $ficha = Cohort::findOrFail($request->cohort_id);

            // Crear la competencia nueva
            $competenciaNueva = Competencies::create([
                'speciality_id'  => $request->speciality_id,
                'name'           => $request->name,
                'duration_hours' => $request->duration_hours,
            ]);

            // Asignarla a la ficha
            $ficha->competences()->attach($competenciaNueva->id, [
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::connection('db_programacion')->commit();

            return redirect()->back()->with('success', '✅ Competencia creada y asignada correctamente.');
        } catch (\Exception $e) {
            DB::connection('db_programacion')->rollBack();
            return redirect()->back()->with('error', '❌ Error: ' . $e->getMessage());
        }
    }



     // 3. Copiar competencias desde OTRA ficha (manual)
    public function copyCompetenciesFromCohort(Request $request)
    {
        $request->validate([
            'target_cohort_id' => 'required|exists:db_programacion.cohorts,id', // Cambiado a target_cohort_id
            'source_cohort_id' => 'required|exists:db_programacion.cohorts,id',
        ]);

        try {
            DB::connection('db_programacion')->beginTransaction();

            $fichaDestino = Cohort::with('competences')->findOrFail($request->target_cohort_id);
            $fichaOrigen = Cohort::with('competences')->findOrFail($request->source_cohort_id);

            // Validar que sean del mismo programa
            if ($fichaDestino->id_program !== $fichaOrigen->id_program) {
                throw new \Exception('Las fichas deben pertenecer al mismo programa de formación');
            }

            // Validar que la ficha origen tenga competencias
            if ($fichaOrigen->competences->isEmpty()) {
                throw new \Exception('La ficha origen no tiene competencias para copiar');
            }

            // Obtener IDs de competencias que ya están asignadas
            $existingCompetenceIds = $fichaDestino->competences->pluck('id')->toArray();

            // Filtrar competencias que no están ya asignadas
            $newCompetenceIds = $fichaOrigen->competences
                ->pluck('id')
                ->reject(function ($competenceId) use ($existingCompetenceIds) {
                    return in_array($competenceId, $existingCompetenceIds);
                })
                ->toArray();

            // Asignar solo las competencias que no existen
            if (!empty($newCompetenceIds)) {
                $fichaDestino->competences()->attach($newCompetenceIds);

                DB::connection('db_programacion')->commit();

                return redirect()->back()->with('success',
                    '✅ Se copiaron ' . count($newCompetenceIds) . ' competencias desde la ficha ' .
                    $fichaOrigen->number_cohort
                );
            } else {
                DB::connection('db_programacion')->rollBack();
                return redirect()->back()->with('info',
                    'ℹ️ Todas las competencias de la ficha origen ya están asignadas a esta ficha'
                );
            }

        } catch (\Exception $e) {
            DB::connection('db_programacion')->rollBack();
            return redirect()->back()->with('error', '❌ Error: ' . $e->getMessage());
        }
    }







}

