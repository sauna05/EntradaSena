<?php

namespace App\Http\Controllers\DbProgramacion;

use App\Http\Controllers\Controller;
use App\Mail\ProgramacionCompetenciaMail;
use App\Models\DbProgramacion\Apprentice;
use App\Models\DbProgramacion\Block;
use App\Models\DbProgramacion\Classroom;
use App\Models\DbProgramacion\Cohort;
use App\Models\DbProgramacion\Competencies;
use App\Models\DbProgramacion\Day;
use App\Models\DbProgramacion\Days_training;
use App\Models\DbProgramacion\Instructor;
use App\Models\DbProgramacion\Program as dbProgramacionPrograman;
use App\Models\DbProgramacion\Program_Level;
use App\Models\DbProgramacion\Programming;
use App\Models\DbProgramacion\Speciality;
use App\Models\DbProgramacion\Town;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProgramanController extends Controller
{
    /**
     * Display a listing of the resource.
     */


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
    public function register_programan(Request $request)
    {
        // Validación de datos
        $request->validate([
            'id_level' => 'required|exists:db_programacion.program_level,id',
            'program_code' => 'required|string|max:255',
            'program_version' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'instructor_id' => 'required|exists:db_programacion.instructors,id',
        ]);

        // Opción 1: guardar usando create (requiere definir fillable en el modelo)
        dbProgramacionPrograman::create([
            'id_level' => $request->id_level,
            'program_code' => $request->program_code,
            'program_version' => $request->program_version,
            'name' => $request->name,
            'instructor_id'=>$request->instructor_id,
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
        $especialidad=Speciality::with('competencies')->get();

        // Competencias no asignadas a ningún programa
        $competencias = Competencies::whereDoesntHave('instructors')->get();

        return view('pages.programming.Admin.programming_instructor.programming_add_competences_profiles', compact('instructors', 'competencias','especialidad'));
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
        $competencies = Competencies::all(); // Cambia all() por paginate(10)
        $especialidad = Speciality::all();
        return view('pages.programming.Admin.Competencies.competencies_index', compact('competencies', 'especialidad'));
    }

    // Guardar nueva competencia
    public function competencies_store(Request $request)
    {
        // Validar datos
        $validated = $request->validate([
            'speciality_id'=> 'required|exists:db_programacion.specialities,id',
            'name' => 'required|string|max:255',
            'duration_hours' => 'required|integer|min:1',
        ]);

        // Crear y guardar nueva competencia
        Competencies::create($validated);

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'Competencia registrada correctamente.');
    }



    //metodo de controlador para listar  los instructores que estan registrados

    public function instructores_index()
    {
        $instructores = Instructor::with(['person', 'speciality', 'programming'])->get();

        foreach ($instructores as $instructor) {
            // Sumar las horas programadas en estados activos
            $horasProgramadas = $instructor->programming
                ->whereIn('status', ['pendiente', 'en_ejecucion','finalizada_evaluada'])
                ->sum('hours_duration'); // Se deben contar las horas reales (no las diarias)

            // Calcular horas restantes
            $instructor->horas_restantes = max(0, $instructor->assigned_hours - $horasProgramadas);
            $instructor->horas_programadas = $horasProgramadas;
        }

        return view('pages.programming.Admin.programming_instructor.programming_instructor_index', compact('instructores'));
    }



    //metodo que lista solo programaciones en estado pendiente y en ejecucion y finalizada no evaluda

    public function programaciones_index()
    {
        try {
            $programaciones = Programming::with([
                'instructor.person',
                'cohort.program',
                'competencie',
                'classroom',
                'days'
            ])->get();

            $now = Carbon::now();

            foreach ($programaciones as $prog) {
                $startDate = Carbon::parse($prog->start_date);
                $endDate = Carbon::parse($prog->end_date);

                if ($now->lt($startDate)) {
                    $prog->status = 'pendiente';
                } elseif ($now->between($startDate, $endDate)) {
                    $prog->status = 'en_ejecucion';
                } else {
                    $prog->status = $prog->evaluated
                        ? 'finalizada_evaluada'
                        : 'finalizada_no_evaluada';
                }

                if ($prog->isDirty('status')) {
                    $prog->save();
                }
            }

            // 🔥 Obtener las últimas programaciones por competencia
            $ultimasProgramaciones = Programming::selectRaw('MAX(id) as id')
                ->groupBy('id_competencie')
                ->pluck('id')
                ->toArray();

            // ❗Filtrar solo programaciones en los estados deseados
            $programaciones = $programaciones->filter(function ($prog) {
                return in_array($prog->status, ['pendiente', 'en_ejecucion', 'finalizada_no_evaluada']);
            });

            return view(
                'pages.programming.Admin.programming_instructor.programming_index',
                compact('programaciones', 'ultimasProgramaciones')
            );
        } catch (Exception $ex) {
            return redirect()->back()
                ->with('error', 'Error al listar las programaciones: ' . $ex->getMessage());
        }
    }






    //metodo de agregar filtro de programaciones estado por competencia

    public function programming_index()
    {
        try {
            $programaciones = Programming::with([
                'instructor.person',
                'cohort.program',
                'competencie',
                'classroom',
                'days'
            ])->get();

            $now = Carbon::now();

            foreach ($programaciones as $prog) {
                $startDate = Carbon::parse($prog->start_date);
                $endDate = Carbon::parse($prog->end_date);

                if ($now->lt($startDate)) {
                    $prog->status = 'pendiente';
                } elseif ($now->between($startDate, $endDate)) {
                    $prog->status = 'en_ejecucion';
                } else {
                    $prog->status = $prog->evaluated
                        ? 'finalizada_evaluada'
                        : 'finalizada_no_evaluada';
                }

                // Guardar solo si cambió el estado
                if ($prog->isDirty('status')) {
                    $prog->save();
                }
            }

            // 🔥 Obtener las últimas programaciones por competencia
            $ultimasProgramaciones = Programming::selectRaw('MAX(id) as id')
                ->groupBy('id_competencie')
                ->pluck('id')
                ->toArray();

            return view(
                'pages.programming.Admin.programming_instructor.programming_programming_index',
                compact('programaciones', 'ultimasProgramaciones')
            );
        } catch (Exception $ex) {
            return redirect()->back()
                ->with('error', 'Error al listar las programaciones: ' . $ex->getMessage());
        }
    }



    //metodo para la vista de retornar la vista de programaciones con su estado deregistro

    public function programming_update_index()
    {
        try {
            $programaciones = Programming::with([
                'instructor.person',
                'cohort.program',
                'competencie',
                'classroom',
                'days'
            ])->get();

            return view('pages.programming.Admin.programming_instructor.programming_update', compact('programaciones'));
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Error al listar las programaciones: ' . $ex->getMessage());
        }
    }

    //metodo para acutalizar programacion de estado sin registrar a ok

    public function updateStatus($id)
    {
        $prog = Programming::findOrFail($id);
        $prog->statu_programming = 'ok';
        $prog->save();

        return redirect()->back()->with('success', '¡Programación marcada como registrada!');
    }

    //para calendario




    //metodo para registrar programacion

    public function register_programmig(Request $request)
    {
        try {
            // Validación de los datos recibidos
            $validated = $request->validate([
                'instructor_id' => 'required|exists:db_programacion.instructors,id',
                'ficha_id' => 'required|exists:db_programacion.cohorts,id',
                'competencia_id' => 'required|exists:db_programacion.competencies,id',
                'ambiente_id' => 'required|exists:db_programacion.classrooms,id',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
                'hora_inicio' => 'required',
                'hora_fin' => 'required',
                'dias' => 'required|array',
                'dias.*' => 'string|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
            ]);

            $horaInicioNueva = Carbon::parse($validated['hora_inicio']);
            $horaFinNueva = Carbon::parse($validated['hora_fin']);

            /** VALIDACIÓN DE AMBIENTE OCUPADO */
            $programacionesAmbiente = Programming::where('id_classroom', $validated['ambiente_id'])
                ->where(function ($query) use ($validated) {
                    $query->whereBetween('start_date', [$validated['fecha_inicio'], $validated['fecha_fin']])
                        ->orWhereBetween('end_date', [$validated['fecha_inicio'], $validated['fecha_fin']])
                        ->orWhere(function ($query) use ($validated) {
                            $query->where('start_date', '<=', $validated['fecha_inicio'])
                                ->where('end_date', '>=', $validated['fecha_fin']);
                        });
                })
                ->when($request->has('id_programacion_anterior'), function ($query) use ($request) {
                    $query->where('id', '!=', $request->id_programacion_anterior);
                })
                ->with('days')
                ->get();


            foreach ($programacionesAmbiente as $programacion) {
                $diasProgramados = $programacion->days->pluck('name')->toArray();
                $diasCoinciden = array_intersect($validated['dias'], $diasProgramados);

                if (!empty($diasCoinciden)) {
                    $horaInicioExistente = Carbon::parse($programacion->start_time)->format('H:i');
                    $horaFinExistente = Carbon::parse($programacion->end_time)->format('H:i');

                    if (
                        $horaInicioNueva < Carbon::parse($programacion->end_time) &&
                        $horaFinNueva > Carbon::parse($programacion->start_time)
                    ) {
                        $diasMensaje = implode(', ', $diasCoinciden);
                        $mensaje = "El ambiente está ocupado el/los día(s): {$diasMensaje} entre las {$horaInicioExistente} y {$horaFinExistente}.";
                        return redirect()->back()->with('error', $mensaje);
                    }
                }
            }

            /** VALIDACIÓN DE INSTRUCTOR CON DOBLE ASIGNACIÓN */
            $programacionesInstructor = Programming::where('id_instructor', $validated['instructor_id'])
                ->where(function ($query) use ($validated) {
                    $query->whereBetween('start_date', [$validated['fecha_inicio'], $validated['fecha_fin']])
                        ->orWhereBetween('end_date', [$validated['fecha_inicio'], $validated['fecha_fin']])
                        ->orWhere(function ($query) use ($validated) {
                            $query->where('start_date', '<=', $validated['fecha_inicio'])
                                ->where('end_date', '>=', $validated['fecha_fin']);
                        });
                })
                ->with('days')
                ->get();

            foreach ($programacionesInstructor as $programacion) {
                $diasProgramados = $programacion->days->pluck('name')->toArray();
                $diasCoinciden = array_intersect($validated['dias'], $diasProgramados);

                if (!empty($diasCoinciden)) {
                    $horaInicioExistente = Carbon::parse($programacion->start_time)->format('H:i');
                    $horaFinExistente = Carbon::parse($programacion->end_time)->format('H:i');

                    if (
                        $horaInicioNueva < Carbon::parse($programacion->end_time) &&
                        $horaFinNueva > Carbon::parse($programacion->start_time)
                    ) {
                        $diasMensaje = implode(', ', $diasCoinciden);
                        $mensaje = "El instructor ya tiene programación el/los día(s): {$diasMensaje} entre las {$horaInicioExistente} y {$horaFinExistente}.";
                        return redirect()->back()->with('error', $mensaje);
                    }
                }
            }

            /** CÁLCULO DE HORAS TOTALES EXCLUYENDO FECHAS NO LABORABLES */
            $diasSemana = [
                'Lunes' => 1,
                'Martes' => 2,
                'Miércoles' => 3,
                'Jueves' => 4,
                'Viernes' => 5,
                'Sábado' => 6,
                'Domingo' => 0,
            ];

            $diasNumericos = array_map(fn($dia) => $diasSemana[$dia], $validated['dias']);
            $horasPorDia = $horaInicioNueva->floatDiffInHours($horaFinNueva);

            $start = Carbon::parse($validated['fecha_inicio']);
            $end = Carbon::parse($validated['fecha_fin']);

            $fechasExcluidas = \App\Models\DbProgramacion\Days_training::pluck('date')
                ->map(fn($f) => Carbon::parse($f)->format('Y-m-d'))->toArray();

            $totalHoras = 0;
            $diasEfectivos = 0;

            while ($start->lte($end)) {
                $diaEsValido = in_array($start->dayOfWeek, $diasNumericos);
                $fechaNoLaborable = in_array($start->format('Y-m-d'), $fechasExcluidas);

                if ($diaEsValido && !$fechaNoLaborable) {
                    $totalHoras += $horasPorDia;
                    $diasEfectivos++;
                }

                $start->addDay();
            }

            // VALIDACIÓN FINAL: NO registrar si no hay días efectivos o totalHoras insuficientes
            if ($diasEfectivos <= 0 || $totalHoras <= 0) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'La programación no tiene días hábiles válidos. Por favor, selecciona un rango de fechas más amplio o revisa los días excluidos.');
            }


            /** CREACIÓN DE LA PROGRAMACIÓN */
            $programming = Programming::create([
                'id_cohort' => $validated['ficha_id'],
                'id_instructor' => $validated['instructor_id'],
                'id_competencie' => $validated['competencia_id'],
                'id_classroom' => $validated['ambiente_id'],
                'hours_duration' => $totalHoras,
                'scheduled_hours' => $horasPorDia,
                'start_date' => $validated['fecha_inicio'],
                'end_date' => $validated['fecha_fin'],
                'start_time' => $validated['hora_inicio'],
                'end_time' => $validated['hora_fin'],
            ]);

            // Asociar días seleccionados
            $diasSeleccionados = Day::whereIn('name', $validated['dias'])->pluck('id')->toArray();
            $programming->days()->sync($diasSeleccionados);

            // Enviar correo al instructor
            $instructorEmail = $programming->instructor->person->email ?? null;

            if ($instructorEmail) {
                Mail::to($instructorEmail)->send(new ProgramacionCompetenciaMail($programming));
            }

            return redirect()->back()->with('success', 'Programación registrada correctamente');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al registrar la programación: ' . $e->getMessage());
        }
    }

    // Vista para registrar nuevo
    public function registerProgramming_index()
    {
        return view('pages.programming.Admin.programming_instructor.instructor_add_programming', [
            'instructors' => Instructor::with(['person', 'competencies', 'speciality'])->get(),
            'cohorts' => Cohort::with('program')->get(),
            'ambientes' => Classroom::with('towns')->get(),
            'competencias' => Competencies::all(),
            'modo' => 'nuevo'
        ]);
    }

    // Vista para reprogramar
    public function programming_index_edit($id)
    {
        $programacion = Programming::with([
            'instructor.person',
            'cohort.program',
            'classroom.towns',
            'competencie',
            'days'
        ])->findOrFail($id);

        return view('pages.programming.Admin.programming_instructor.instructor_reprogramming', [
            'programacion' => $programacion,
            'instructors' => Instructor::with(['person', 'competencies', 'speciality'])->get(),
            'cohorts' => Cohort::with('program')->get(),
            'ambientes' => Classroom::with('towns')->get(),
            'competencias' => Competencies::all(),
            'allDays' => Day::all(),
            'modo' => 'reprogramar'
        ]);
    }




    public function updateProgramming(Request $request, $id)
    {
        // VALIDACIÓN de datos de entrada
        $validated = $request->validate([
            'id_cohort' => 'required|exists:db_programacion.cohorts,id',
            'id_instructor' => 'required|exists:db_programacion.instructors,id',
            'id_competencie' => 'required|exists:db_programacion.competencies,id',
            'id_classroom' => 'required|exists:db_programacion.classrooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'end_time' => 'required',
            'scheduled_hours' => 'required|numeric|min:0.1',
            'hours_duration' => 'required|numeric|min:0.1',
            'dias' => 'required|array|min:1'
        ]);

        $horaInicioNueva = Carbon::parse($validated['start_time']);
        $horaFinNueva = Carbon::parse($validated['end_time']);

        /** VALIDACIÓN DE AMBIENTE OCUPADO */
        $programacionesAmbiente = Programming::where('id_classroom', $validated['id_classroom'])
            ->where('id', '!=', $id) // Excluir la misma programación
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                    ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('start_date', '<=', $validated['start_date'])
                            ->where('end_date', '>=', $validated['end_date']);
                    });
            })
            ->with('days')
            ->get();

        foreach ($programacionesAmbiente as $programacion) {
            $diasProgramados = $programacion->days->pluck('name')->toArray();
            $diasCoinciden = array_intersect($validated['dias'], $diasProgramados);

            if (!empty($diasCoinciden)) {
                if (
                    $horaInicioNueva < Carbon::parse($programacion->end_time) &&
                    $horaFinNueva > Carbon::parse($programacion->start_time)
                ) {
                    $mensaje = "El ambiente está ocupado el/los día(s): " . implode(', ', $diasCoinciden) .
                        " entre las " . Carbon::parse($programacion->start_time)->format('H:i') .
                        " y " . Carbon::parse($programacion->end_time)->format('H:i') . ".";
                    return back()->with('error', $mensaje);
                }
            }
        }

        /** VALIDACIÓN DE INSTRUCTOR CON DOBLE ASIGNACIÓN */
        $programacionesInstructor = Programming::where('id_instructor', $validated['id_instructor'])
            ->where('id', '!=', $id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                    ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('start_date', '<=', $validated['start_date'])
                            ->where('end_date', '>=', $validated['end_date']);
                    });
            })
            ->with('days')
            ->get();

        foreach ($programacionesInstructor as $programacion) {
            $diasProgramados = $programacion->days->pluck('name')->toArray();
            $diasCoinciden = array_intersect($validated['dias'], $diasProgramados);

            if (!empty($diasCoinciden)) {
                if (
                    $horaInicioNueva < Carbon::parse($programacion->end_time) &&
                    $horaFinNueva > Carbon::parse($programacion->start_time)
                ) {
                    $mensaje = "El instructor ya tiene programación el/los día(s): " . implode(', ', $diasCoinciden) .
                        " entre las " . Carbon::parse($programacion->start_time)->format('H:i') .
                        " y " . Carbon::parse($programacion->end_time)->format('H:i') . ".";
                    return back()->with('error', $mensaje);
                }
            }
        }

        /** CÁLCULO DE HORAS TOTALES EXCLUYENDO DÍAS NO LABORABLES */
        $diasSemana = ['Lunes' => 1, 'Martes' => 2, 'Miércoles' => 3, 'Jueves' => 4, 'Viernes' => 5, 'Sábado' => 6, 'Domingo' => 0];
        $diasNumericos = array_map(fn($dia) => $diasSemana[$dia], $validated['dias']);
        $horasPorDia = $horaInicioNueva->floatDiffInHours($horaFinNueva);

        $start = Carbon::parse($validated['start_date']);
        $end = Carbon::parse($validated['end_date']);

        $fechasExcluidas = \App\Models\DbProgramacion\Days_training::pluck('date')
            ->map(fn($f) => Carbon::parse($f)->format('Y-m-d'))->toArray();

        $totalHoras = 0;
        $diasEfectivos = 0;

        while ($start->lte($end)) {
            if (
                in_array($start->dayOfWeek, $diasNumericos) &&
                !in_array($start->format('Y-m-d'), $fechasExcluidas)
            ) {
                $totalHoras += $horasPorDia;
                $diasEfectivos++;
            }
            $start->addDay();
        }

        if ($diasEfectivos <= 0 || $totalHoras <= 0) {
            return back()->withInput()->with('error', 'No hay días hábiles válidos.');
        }

        // Recuperar programación actual
        $programacion = Programming::findOrFail($id);
        $horasAnteriores = $programacion->hours_duration;

        // 1. Devolver horas al instructor anterior
        $instructorAnterior = Instructor::find($programacion->id_instructor);
        if ($instructorAnterior) {
            $instructorAnterior->assigned_hours = max(0, $instructorAnterior->assigned_hours - $horasAnteriores);
            $instructorAnterior->save();
        }

        $programacion->update([
            'id_cohort' => $validated['id_cohort'],
            'id_instructor' => $validated['id_instructor'],
            'id_competencie' => $validated['id_competencie'],
            'id_classroom' => $validated['id_classroom'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'scheduled_hours' => $horasPorDia,
            'hours_duration' => $horasAnteriores + $totalHoras,
            'status' => 'pendiente',
            'statu_programming' => 'sin_registrar',
            'evaluated' => false,
        ]);
        $instructorNuevo = Instructor::find($request->id_instructor);
        if ($instructorNuevo) {
            $instructorNuevo->assigned_hours += $totalHoras;
            $instructorNuevo->save();
        }

        // ACTUALIZAR DÍAS
        $diasSeleccionados = Day::whereIn('name', $validated['dias'])->pluck('id')->toArray();
        $programacion->days()->sync($diasSeleccionados);

        // Enviar correo
        $instructorEmail = $programacion->instructor->person->email ?? null;
        if ($instructorEmail) {
            Mail::to($instructorEmail)->send(new ProgramacionCompetenciaMail($programacion));
        }

        return redirect()->route('programming.programming_index_states')->with('success', 'Programación actualizada correctamente.');
    }




    protected function hayCruce($programaciones, $diasNuevos, $horaInicioNueva, $horaFinNueva, &$mensaje)
    {
        foreach ($programaciones as $programacion) {
            $diasProgramados = $programacion->days->pluck('name')->toArray();
            $diasCoinciden = array_intersect($diasNuevos, $diasProgramados);

            if (!empty($diasCoinciden)) {
                if ($horaInicioNueva < $programacion->end_time && $horaFinNueva > $programacion->start_time) {
                    $mensaje = implode(', ', $diasCoinciden) . " entre {$programacion->start_time} y {$programacion->end_time}";
                    return true;
                }
            }
        }
        return false;
    }

    //metodo para actualizar a evaluda la competencia
    public function evaluateProgramming($id)
    {
        $prog = Programming::findOrFail($id);

        // Solo permitir evaluar si está en estado finalizada_no_evaluada
        if ($prog->status === 'finalizada_no_evaluada') {
            $prog->status = 'finalizada_evaluada';
            $prog->evaluated = true;
            $prog->save();

            return redirect()->back()->with('success', '¡Programación evaluada correctamente!');
        }

        return redirect()->back()->with('error', 'Esta programación no puede ser evaluada.');
    }
    //metodo para registrar un nuevo ambiente


    public function classroom_store(Request $request)
    {
        $request->validate([
            'id_town' => 'required|exists:db_programacion.towns,id',
            'id_block' => 'required|exists:db_programacion.blocks,id',
            'name' => 'required|string|max:255',
        ]);

        Classroom::create([
            'id_town' => $request->id_town,
            'id_block' => $request->id_block,
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Ambiente registrado correctamente.');
    }

    public function deleteClassroom($id){

        //ELOQUENT ORM
        $ambiente_eliminar=Classroom::findOrfail($id);
        $ambiente_eliminar->delete();

        return redirect()->back()->with('success','Ambiente eliminado correctamente');

    }

    //metido para editar ambiente
    public function classroom_update(Request $request, $id)
    {
        $request->validate([
            'id_town' => 'required|exists:db_programacion.towns,id',
            'id_block' => 'required|exists:db_programacion.blocks,id',
            'name' => 'required|string|max:255',
        ]);

        $classroom = Classroom::findOrFail($id);

        $classroom->update([
            'id_town' => $request->id_town,
            'id_block' => $request->id_block,
            'name' => $request->name,
        ]);

        return redirect()->back() // Ajusta esta ruta
            ->with('success', 'Ambiente actualizado correctamente.');
    }







    //metodo para visualizar el estado de horario de los ambientes disponibles no disponibles  y demas
    public function index_classroom()
    {
        $municipios=Town::all();
        $bloques=Block::all();
        $ambientes = Classroom::with(['programming.days', 'programming.instructor.person'])->get();
        $jornadaInicio = '08:00:00';
        $jornadaFin = '18:00:00';

        $ambientes->each(function ($ambiente) use ($jornadaInicio, $jornadaFin) {
            $programaciones = $ambiente->programming->filter(function ($p) {
                return Carbon::parse($p->end_date)->gte(Carbon::today());
            });

            if ($programaciones->isEmpty()) {
                $ambiente->rango_fechas = null;
                $ambiente->horas_programadas = [];
                $ambiente->horas_disponibles = [];
                return;
            }

            $ambiente->rango_fechas = [
                'inicio' => $programaciones->min('start_date'),
                'fin' => $programaciones->max('end_date'),
            ];

            $horasProgramadas = [];
            $horasDisponiblesPorDia = [];

            foreach ($programaciones as $p) {
                $fechaInicio = Carbon::parse($p->start_date);
                $fechaFin = Carbon::parse($p->end_date);
                $dias = $p->days->pluck('name')->toArray();

                while ($fechaInicio->lte($fechaFin)) {
                    $nombreDia = ucfirst(Carbon::parse($fechaInicio)->isoFormat('dddd'));

                    if (in_array($nombreDia, $dias)) {
                        $fechaStr = $fechaInicio->toDateString();

                        $horasProgramadas[] = [
                            'fecha' => $fechaStr,
                            'start' => $p->start_time,
                            'end' => $p->end_time,
                            'instructor' => $p->instructor->person->name ?? 'Sin instructor' // Agregamos el nombre del instructor
                        ];

                        $bloques = $horasDisponiblesPorDia[$fechaStr]['bloques'] ?? [];
                        $bloques[] = [
                            'start' => $p->start_time,
                            'end' => $p->end_time
                        ];
                        $horasDisponiblesPorDia[$fechaStr]['bloques'] = $bloques;
                    }

                    $fechaInicio->addDay();
                }
            }
            // Calcular horas disponibles por fecha
            $horas_disponibles = [];
            foreach ($horasDisponiblesPorDia as $fecha => $info) {
                $bloques = collect($info['bloques'])->sortBy('start')->values();
                $disponibles = [];
                $horaActual = $jornadaInicio;

                foreach ($bloques as $b) {
                    if ($horaActual < $b['start']) {
                        $disponibles[] = [
                            'start' => $horaActual,
                            'end' => $b['start']
                        ];
                    }
                    $horaActual = max($horaActual, $b['end']);
                }

                if ($horaActual < $jornadaFin) {
                    $disponibles[] = [
                        'start' => $horaActual,
                        'end' => $jornadaFin
                    ];
                }

                $horas_disponibles[] = [
                    'fecha' => $fecha,
                    'disponibles' => $disponibles
                ];
            }

            $ambiente->horas_programadas = $horasProgramadas;
            $ambiente->horas_disponibles = $horas_disponibles;
        });

        return view('pages.programming.Admin.Ambientes.ambientes_index', compact('ambientes','municipios','bloques'));
    }

    //metodos para gestionar calendario academico
    public function daysCalendar()
    {
        $query = Days_training::query();

        // Si no hay filtro de año, usar el actual por defecto
        $year = request()->get('year', now()->year);
        $query->whereYear('date', $year);

        // Si el usuario seleccionó un mes, también filtrarlo
        if (request()->filled('month')) {
            $query->whereMonth('date', request('month'));
        }

        $days = $query->orderBy('date','desc')->get();

        return view('pages.programming.Admin.programming_instructor.programming_day_calendar_index', compact('days'));
    }


    public function daysCalendarStore(Request $request)
    {
        $request->validate([
            'date' => [
                'required',
                'date',
                'unique:db_programacion.days_without_training,date',
                function ($attribute, $value, $fail) {
                    $dayOfWeek = Carbon::parse($value)->dayOfWeek;

                    // 0 = domingo, 6 = sábado
                    if ($dayOfWeek === 0 || $dayOfWeek === 6) {
                        $fail('Solo se pueden registrar días de lunes a viernes.');
                    }
                },
            ],
            'reason' => 'required|string|max:255',
        ]);

        Days_training::create([
            'date' => $request->date,
            'reason' => $request->reason
        ]);

        return redirect()->back()->with('success', 'Día registrado exitosamente.');
    }
    //agregar que una ves se programen las horas del instructor se le descuenten de las asignadas

    public function day_delete($id)
    {
        $day = Days_training::findOrFail($id);
        $day->delete();
        return redirect()->back()->with('success', 'Día eliminado correctamente.');
    }



}
