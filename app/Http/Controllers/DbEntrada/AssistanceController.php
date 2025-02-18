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
        // Obtener los términos 
        $searchTerm = $request->input('search');
        $positionId = $request->input('position_id');
        $filterDate = $request->input('filter_date');

        $personsQuery = Person::with(['position', 'entrances_exits' => function ($query) use ($filterDate) {
            $query->orderBy('date_time', 'asc'); // Asegura que las entradas/salidas estén ordenadas por fecha y hora

            // Filtrar por fecha
            if ($filterDate) {
                $query->whereDate('date_time', '=', $filterDate);
            }
        }])
        ->has('entrances_exits'); // Filtra solo las personas que tienen entradas/salidas

        // Aplicar filtro 
        if ($searchTerm) {
            $personsQuery->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('document_number', 'like', '%' . $searchTerm . '%'); 
            });
        }

        // Aplicar filtro 
        if ($positionId) {
            $personsQuery->where('id_position', $positionId); 
        }

        $persons = $personsQuery->get();
        $totalPersons = $persons->count();

        // Formatear los datos para la vista
        $formattedPersons = $persons->map(function ($person) {
            $entrances_exits_by_date = $person->entrances_exits->groupBy(function ($item) {
                return Carbon::parse($item->date_time)->format('Y-m-d'); // Agrupa por fecha
            });

            $dailyData = $entrances_exits_by_date->map(function ($entries, $date) {
                $firstEntry = $entries->first();
                $lastEntry = $entries->count() > 1 ? $entries->last() : null;

                $salida = $lastEntry ? Carbon::parse($lastEntry->date_time)->format('H:i:s') : 'No ha escaneado salida';

                return [
                    'date' => $date,
                    'entrada' => $firstEntry ? Carbon::parse($firstEntry->date_time)->format('H:i:s') : 'Sin registro',
                    'salida' => $salida,
                ];
            })->values();

            return [
                'id' => $person->id,
                'name' => $person->name,
                'position' => $person->position->position ?? 'Sin puesto',
                'daily_data' => $dailyData,
            ];
        });

        $positions = Position::all();

        return view('pages.entrance.admin.assistance.assistance_index', compact('formattedPersons', 'positions', 'totalPersons'));
    }
}
