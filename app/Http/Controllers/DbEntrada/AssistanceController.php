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
            // Obtener los términos de búsqueda
            $searchTerm = $request->input('search');
            $positionId = $request->input('position_id');
            // Usar la fecha actual como filtro por defecto
            $filterDate = $request->input('filter_date', now()->toDateString());

            // Obtener los puestos (esto debe estar disponible en todos los casos)
            $positions = Position::all();

            $personsQuery = Person::with(['position', 'entrances_exits' => function ($query) use ($filterDate) {
                $query->orderBy('date_time', 'asc')
                    ->whereDate('date_time', '=', $filterDate); // Filtrar por fecha
            }])
            ->whereHas('entrances_exits', function ($query) use ($filterDate) {
                $query->whereDate('date_time', '=', $filterDate);
            }); // Asegura que solo se obtengan personas con entradas/salidas en la fecha filtrada

            // Aplicar filtro de búsqueda por nombre o documento
            if ($searchTerm) {
                $personsQuery->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('document_number', 'like', '%' . $searchTerm . '%');
                });
            }

            // Aplicar filtro por posición
            if ($positionId) {
                $personsQuery->where('id_position', $positionId);
            }

            $persons = $personsQuery->get();
            $totalPersons = $persons->count();

            // Verificar si hay personas con asistencia registrada
            if ($totalPersons === 0) {
                return view('pages.entrance.admin.assistance.assistance_index', [
                    'formattedPersons' => [],
                    'positions' => $positions,
                    'totalPersons' => 0,
                    'noAttendanceMessage' => true, // Variable para indicar que no hay asistencias
                ]);
            }

            // Formatear los datos para la vista
            $formattedPersons = $persons->map(function ($person) {
                // Agrupar las entradas/salidas por fecha
                $entrances_exits_by_date = $person->entrances_exits->groupBy(function ($item) {
                    return Carbon::parse($item->date_time)->format('Y-m-d');
                });

                // Obtener datos diarios
                $dailyData = $entrances_exits_by_date->map(function ($entries, $date) {
                    $firstEntry = $entries->first();
                    $lastEntry = $entries->count() > 1 ? $entries->last() : null;

                    return [
                        'date' => $date,
                        'entrada' => $firstEntry ? Carbon::parse($firstEntry->date_time)->format('H:i:s') : 'Sin registro',
                        'salida' => $lastEntry ? Carbon::parse($lastEntry->date_time)->format('H:i:s') : 'No ha escaneado salida',
                    ];
                })->values();

                return [
                    'id' => $person->id,
                    'name' => $person->name,
                    'document_number'=>$person->document_number,
                    'position' => $person->position->position ?? 'Sin puesto',
                    'daily_data' => $dailyData,
                ];
            });

            return view('pages.entrance.admin.assistance.assistance_index', compact('formattedPersons', 'positions', 'totalPersons'));
        }




        //metodo show Asistances
        public function showPeoples($id)
        {
            $person = Person::with(['position', 'entrances_exits' => function ($query) {
                $query->orderBy('date_time', 'asc');
            }])->findOrFail($id);
    
            // Formatear los datos de asistencia para la vista
            $formattedEntrancesExits = $person->entrances_exits->map(function ($entry) {
                return [
                    'date' => Carbon::parse($entry->date_time)->format('Y-m-d'),
                    'time' => Carbon::parse($entry->date_time)->format('H:i:s'),
                    'action' => $entry->action, // 'entrada' or 'salida' or whatever your action values are
                ];
            });
    
            return view('pages.entrance.admin.assistance.assistance_show', compact('person', 'formattedEntrancesExits'));
        }


}
