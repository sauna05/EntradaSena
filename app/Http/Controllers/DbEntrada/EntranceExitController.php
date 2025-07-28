<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\EntranceExit;
use App\Models\DbProgramacion\Person;
use Carbon\Carbon;

use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class EntranceExitController extends Controller
{
    public function create(){
        return view('pages.entrance.entrance');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'document_number' => 'required|string|max:12|min:9'
        ]);

        $person = Person::where('document_number', $data['document_number'])->first();

        // Si no se encuentra ninguna persona con ese documento
        if (!$person) {
            return response()->json([
                'action' => "DOCUMENTO NO REGISTRADO",
                'position' => "N/A",
                'name' => "Desconocido"
            ]);
        }

        // Se toma la posición de la persona
        $position = $person->position->position ?? 'No definida';

        // Validar fechas de entrada y salida del centro
        if (($person->start_date > now() || $person->end_date < now())) {
            return response()->json([
                'action' => "ACCESO RESTRINGIDO USTED YA NO HACE PARTE DEL CENTRO DE FORMACION",
                'position' => $position,
                'name' => $person->name
            ]);
        }

        // Día actual
        $currentDay = Carbon::now()->format('l');

        $isAvailable = $person->days_available()->where('name_english', $currentDay)->exists();

        if (!$isAvailable) {
            return response()->json([
                'action' => "NO PUEDE ACCEDER HOY AL CENTRO DE FORMACIÓN",
                'position' => $position,
                'name' => $person->name
            ]);
        }

        // Última asistencia
        $last_assistance = EntranceExit::where('id_person', $person->id)
            ->orderBy('date_time', 'desc')
            ->first();

        $action = "entrada";

        if (is_null($last_assistance)) {
            // Primer registro
            EntranceExit::create([
                'id_person' => $person->id,
                'date_time' => now(),
                'action' => $action
            ]);
        } elseif ($last_assistance->date_time->day != now()->day) {
            // Día diferente → entrada
            EntranceExit::create([
                'id_person' => $person->id,
                'date_time' => now(),
                'action' => $action
            ]);
        } elseif ($last_assistance->action == "entrada") {
            // Ya marcó entrada hoy → salida
            $action = "salida";
            EntranceExit::create([
                'id_person' => $person->id,
                'date_time' => now(),
                'action' => $action
            ]);
        } else {
            // Entrada normal
            EntranceExit::create([
                'id_person' => $person->id,
                'date_time' => now(),
                'action' => $action
            ]);
        }

        $position = $person->position->name ?? 'No definida';

        return response()->json([
            'action' => $action,
            'position' => $position,
            'name' => $person->name
        ]);
    }
}
