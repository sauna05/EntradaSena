<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\Person;
use App\Models\DbProgramacion\Position;
use Illuminate\Http\Request;
use Carbon\Carbon;

use PhpParser\Node\Expr\FuncCall;

class AssistanceController extends Controller
{
    public function assistanceIndex(Request $request)
    {
        // Obtener filtros
        $searchTerm = $request->input('search');
        $positionId = $request->input('position_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $month = $request->input('month');

        // Si no hay filtro, usar fecha actual
        $defaultDate = now()->toDateString();

        // Obtener todos los puestos
        $positions = Position::all();

        $personsQuery = Person::with(['position', 'entrances_exits' => function ($query) use ($startDate, $endDate, $month, $defaultDate) {
            if ($month) {
                $query->whereMonth('date_time', '=', Carbon::parse($month)->month)
                    ->whereYear('date_time', '=', Carbon::parse($month)->year);
            } elseif ($startDate && $endDate) {
                $query->whereBetween('date_time', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            } else {
                $query->whereDate('date_time', '=', $defaultDate);
            }
            $query->orderBy('date_time', 'asc');
        }])->whereHas('entrances_exits', function ($query) use ($startDate, $endDate, $month, $defaultDate) {
            if ($month) {
                $query->whereMonth('date_time', '=', Carbon::parse($month)->month)
                    ->whereYear('date_time', '=', Carbon::parse($month)->year);
            } elseif ($startDate && $endDate) {
                $query->whereBetween('date_time', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            } else {
                $query->whereDate('date_time', '=', $defaultDate);
            }
        });

        // Filtro por búsqueda
        if ($searchTerm) {
            $personsQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('document_number', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filtro por posición
        if ($positionId) {
            $personsQuery->where('id_position', $positionId);
        }

        $persons = $personsQuery->get();
        $totalPersons = $persons->count();

        if ($totalPersons === 0) {
            return view('pages.programming.Admin.assistance.assistance_index', [
                'formattedPersons' => [],
                'positions' => $positions,
                'totalPersons' => 0,
                'noAttendanceMessage' => true,
            ]);
        }

        $formattedPersons = [];

        foreach ($persons as $person) {
            $groupedByDate = $person->entrances_exits->groupBy(function ($item) {
                return Carbon::parse($item->date_time)->format('Y-m-d');
            });

            foreach ($groupedByDate as $date => $entries) {
                $firstEntry = $entries->first();
                $lastEntry = $entries->count() > 1 ? $entries->last() : null;

                $entrada = $firstEntry ? Carbon::parse($firstEntry->date_time) : null;
                $salida = $lastEntry ? Carbon::parse($lastEntry->date_time) : null;

                $tiempoCentro = ($entrada && $salida)
                    ? $entrada->diff($salida)->format('%H:%I:%S')
                    : null;

                // Si es solo una fecha (por defecto)
                if (!$startDate && !$endDate && !$month) {
                    if (isset($formattedPersons[$person->id])) {
                        continue;
                    }

                    $formattedPersons[$person->id] = [
                        'id' => $person->id,
                        'name' => $person->name,
                        'document_number' => $person->document_number,
                        'position' => $person->position->name ?? 'Sin puesto',
                        'raw_date' => $date,
                        'daily_data' => [[
                            'date' => Carbon::parse($date)->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY'),
                            'entrada' => $entrada ? $entrada->format('H:i:s a') : 'Sin registro',
                            'salida' => $salida ? $salida->format('H:i:s a') : 'No ha escaneado salida',
                            'tiempo_centro' => $tiempoCentro,
                        ]],
                        'total_time' => $tiempoCentro ?? '00:00:00',
                    ];
                } else {
                    $totalSeconds = 0;
                    if ($tiempoCentro) {
                        list($h, $m, $s) = explode(':', $tiempoCentro);
                        $totalSeconds = $h * 3600 + $m * 60 + $s;
                    }

                    $formattedPersons[] = [
                        'id' => $person->id,
                        'name' => $person->name,
                        'document_number' => $person->document_number,
                        'position' => $person->position->name ?? 'Sin puesto',
                        'raw_date' => $date,
                        'daily_data' => [[
                            'date' => Carbon::parse($date)->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY'),
                            'entrada' => $entrada ? $entrada->format('H:i:s a') : 'Sin registro',
                            'salida' => $salida ? $salida->format('H:i:s a') : 'No ha escaneado salida',
                            'tiempo_centro' => $tiempoCentro,
                        ]],
                        'total_time' => gmdate('H:i:s', $totalSeconds),
                    ];
                }
            }
        }

        usort($formattedPersons, fn($a, $b) => strtotime($a['raw_date']) <=> strtotime($b['raw_date']));

        // Si solo es un día, pasar de array asociativo a indexado
        if (!$startDate && !$endDate && !$month) {
            $formattedPersons = array_values($formattedPersons);
        }

        return view('pages.programming.Admin.assistance.assistance_index', [
            'formattedPersons' => $formattedPersons,
            'positions' => $positions,
            'totalPersons' => count($formattedPersons),
        ]);
    }

    public function allAssistances(Request $request)
    {
        $positionId = $request->input('position_id');
        $positions  = Position::all();

        $personsQuery = Person::with(['position', 'entrances_exits' => function ($q) {
            $q->orderBy('date_time', 'asc');
        }]);

        if ($positionId) {
            $personsQuery->where('id_position', $positionId);
        }

        $persons = $personsQuery->get();

        $formatted = [];

        foreach ($persons as $person) {
            // Agrupo por fecha
            $byDate = $person->entrances_exits
                ->groupBy(fn($e) => Carbon::parse($e->date_time)->format('Y-m-d'));

            foreach ($byDate as $date => $entries) {
                $firstEntry = $entries->first();
                $lastEntry  = $entries->last();

                $entrada = $firstEntry ? Carbon::parse($firstEntry->date_time) : null;
                $salida  = $lastEntry  ? Carbon::parse($lastEntry->date_time)  : null;

                // Calcular tiempo para ese día
                if ($entrada && $salida) {
                    $diffInSeconds = $salida->timestamp - $entrada->timestamp;
                    $h = intdiv($diffInSeconds, 3600);
                    $m = intdiv($diffInSeconds % 3600, 60);
                    $s = $diffInSeconds % 60;
                    $tiempoCentro = sprintf('%02d:%02d:%02d', $h, $m, $s);
                } else {
                    $tiempoCentro = '00:00:00';
                }

                // Clave única persona+fecha
                $key = $person->id . '_' . $date;

                $formatted[$key] = [
                    'id'              => $person->id,
                    'name'            => $person->name,
                    'document_number' => $person->document_number,
                    'position'        => $person->position->name ?? 'Sin puesto',
                    'raw_date'        => $date, // Fecha sin formato para ordenar
                    'daily_data'      => [[
                        'date'          => Carbon::parse($date)
                            ->locale('es')
                            ->isoFormat('dddd D [de] MMMM [de] YYYY'),
                        'entrada'       => $entrada ? $entrada->format('H:i:s a') : 'Sin registro',
                        'salida'        => $salida  ? $salida->format('H:i:s a')  : 'No ha escaneado salida',
                        'tiempo_centro' => $tiempoCentro,
                    ]],
                    'total_time'      => $tiempoCentro,
                ];
            }
        }

        // Ordenar cronológicamente por fecha (de menor a mayor)
        usort($formatted, fn($a, $b) => strtotime($a['raw_date']) <=> strtotime($b['raw_date']));

        // Reindexar para la vista
        $result = array_values($formatted);

        // Almacenar los datos en la sesión
        session(['formattedPersons' => $result]);

        return view('pages.entrance.admin.assistance.assistance_index', [
            'formattedPersons'  => $result,
            'positions'         => $positions,
            'totalPersons'      => count($result),
            'filterAllAssist'   => true,
            'filteredPosition'  => $positionId,
        ]);
    }


    // Método para mostrar detalles de asistencias de una persona
    public function showPeoples($id)
    {
        $person = Person::with(['position', 'entrances_exits' => function ($query) {
            $query->whereDate('date_time', Carbon::today())
                ->orderBy('date_time', 'asc');
        }])->findOrFail($id);

        $formattedEntrancesExits = $person->entrances_exits->map(function ($entry) {
            return [
                'date' => Carbon::parse($entry->date_time)->format('Y-m-d'),
                'time' => Carbon::parse($entry->date_time)->format('H:i:s'),
                'action' => $entry->action,
            ];
        });

        return view('pages.entrance.admin.assistance.assistance_show', compact('person', 'formattedEntrancesExits'));
    }

    public function showPeoples_history($id)
    {
        $person = Person::with(['position', 'entrances_exits' => function ($query) {
            $query->orderBy('date_time', 'asc');
        }])->findOrFail($id);

        $formattedEntrancesExits = $person->entrances_exits->map(function ($entry) {
            return [
                'date' => Carbon::parse($entry->date_time)->format('Y-m-d'),
                'time' => Carbon::parse($entry->date_time)->format('H:i:s'),
                'action' => $entry->action,
            ];
        });

        return view('pages.entrance.admin.assistance.assistance_show_history', compact('person', 'formattedEntrancesExits'));
    }


    //agregar metodo para exportar filtro de asistencia en formato excel

    public function exportExcel() {


    }
}
