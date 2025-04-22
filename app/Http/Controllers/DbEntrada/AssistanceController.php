<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
use App\Models\DbEntrada\Person;
use App\Models\DbEntrada\Position;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AssistanceController extends Controller
{
    public function assistanceIndex(Request $request)
    {
        // Obtener filtros y parámetros
        $searchTerm = $request->input('search');
        $positionId = $request->input('position_id');
        $weekRange = $request->input('week');
        $filterDate = $request->input('filter_date', now()->toDateString());

        $startOfWeek = null;
        $endOfWeek = null;

        if ($weekRange) {
            [$startOfWeek, $endOfWeek] = explode('|', $weekRange);
        }

        // Obtener todos los puestos
        $positions = Position::all();

        // Construir consulta de personas con sus entradas y salidas filtradas
        $personsQuery = Person::with(['position', 'entrances_exits' => function ($query) use ($weekRange, $filterDate, $startOfWeek, $endOfWeek) {
            if ($weekRange && $startOfWeek && $endOfWeek) {
                $query->whereBetween('date_time', [$startOfWeek . ' 00:00:00', $endOfWeek . ' 23:59:59']);
            } else {
                $query->whereDate('date_time', '=', $filterDate);
            }
            $query->orderBy('date_time', 'asc');
        }])->whereHas('entrances_exits', function ($query) use ($weekRange, $filterDate, $startOfWeek, $endOfWeek) {
            if ($weekRange && $startOfWeek && $endOfWeek) {
                $query->whereBetween('date_time', [$startOfWeek . ' 00:00:00', $endOfWeek . ' 23:59:59']);
            } else {
                $query->whereDate('date_time', '=', $filterDate);
            }
        });

        // Filtro por búsqueda de nombre o documento
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

        // Si no hay personas con asistencias, mostrar mensaje
        if ($totalPersons === 0) {
            return view('pages.entrance.admin.assistance.assistance_index', [
                'formattedPersons' => [],
                'positions' => $positions,
                'totalPersons' => 0,
                'noAttendanceMessage' => true,
            ]);
        }

        // Formatear datos para la vista
        $formattedPersons = $persons->map(function ($person) {
            // Agrupar entradas/salidas por fecha
            $entrances_exits_by_date = $person->entrances_exits->groupBy(function ($item) {
                return Carbon::parse($item->date_time)->format('Y-m-d');
            });

            $dailyData = $entrances_exits_by_date->map(function ($entries, $date) {
                $firstEntry = $entries->first();
                $lastEntry = $entries->count() > 1 ? $entries->last() : null;

                $entrada = $firstEntry ? Carbon::parse($firstEntry->date_time) : null;
                $salida = $lastEntry ? Carbon::parse($lastEntry->date_time) : null;

                $tiempoCentro = ($entrada && $salida)
                    ? $entrada->diff($salida)->format('%H:%I:%S')
                    : null;

                return [
                    'date' => $date,
                    'entrada' => $entrada ? $entrada->format('H:i:s') : 'Sin registro',
                    'salida' => $salida ? $salida->format('H:i:s') : 'No ha escaneado salida',
                    'tiempo_centro' => $tiempoCentro,
                ];
            })->values();

            // Calcular tiempo total en segundos sumando todos los días
            $totalSeconds = 0;
            foreach ($dailyData as $day) {
                if ($day['tiempo_centro']) {
                    list($hours, $minutes, $seconds) = explode(':', $day['tiempo_centro']);
                    $totalSeconds += $hours * 3600 + $minutes * 60 + $seconds;
                }
            }
            $totalTimeFormatted = gmdate('H:i:s', $totalSeconds);

            return [
                'id' => $person->id,
                'name' => $person->name,
                'document_number' => $person->document_number,
                'position' => $person->position->name ?? 'Sin puesto',
                'daily_data' => $dailyData,
                'total_time' => $totalTimeFormatted,
            ];
        });

        return view('pages.entrance.admin.assistance.assistance_index', compact('formattedPersons', 'positions', 'totalPersons'));
    }

    // Método para mostrar detalles de asistencias de una persona
    public function showPeoples($id)
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

        return view('pages.entrance.admin.assistance.assistance_show', compact('person', 'formattedEntrancesExits'));
    }
}
