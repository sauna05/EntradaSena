<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
use App\Models\DbEntrada\EntranceExit;
use App\Models\DbEntrada\Person;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class EntranceExitController extends Controller
{
    public function create(){
        return view('pages.entrance.entrance');
    }

    public function store(Request $request){
        //Registrar la entrada
        // Obtener el número de documento  de la persona para buscar a la persona
        
        //si la persona no existe en la db, mostrar que no existe
        //Si la persona si existe, agregar el registro en la tabla entrances_exits
        
        //Si es el primer registro de la persona en el día, se le guarda entrada,
        //si ya tiene registro en ese mismo día, se le guarda salida y se repite el ciclo 
        
        //Si la fecha acutual no está entre el 
        //rango de fechas de entrada-salida en la db, saldrá la entrada prohibida

        //luego tomar los datos de esa persona para luego mostrarlos en el front-end de la pagina de la entrada

       $data= $request->validate([
            'document_number' => 'required|string|max:12|min:9'
        ]);

        $person = Person::where('document_number', $data['document_number'])->first();

        //Se toma la posición de la persona
        $position = $person->position->position;

        //Si la fecha actual no está dentro del rango de fechas de inicio y final de la persona en el centro de formación
        //No se le dará permiso
        if (($person->start_date > now() || $person->end_date < now()) || false) {
            return response()->json([
                'action' => "ACCESO RESTRINGIDO",
                'position' => "No forma parte del centro actualmente",
                'name' => $person->name
            ]);
        }
      

        //Se obtiene el día de hoy en ingles EJ Martes = Tuesday
        $currentDay = Carbon::now()->format('l');

        $isAvailable = $person->days_available()->where('day_english', $currentDay)->exists();
        
        if(!$isAvailable){
            return response()->json([
                'action' => "NO PUEDE ACCEDER HOY AL CENTRO DE FORMACIÓN",
                'position' => $position,
                'name' => $person->name
            ]);
        }

        //ultima asistencia de la persona
        $last_assistance = EntranceExit::where('id_person',$person->id)
        ->orderBy('date_time', 'desc')
        ->first();
        
        //La acción es 'entrada' por defecto(se registra primero entrada todos los días)
        $action = "entrada";
        
        //Si es la primera vez que la persona registra asistencia
        if (is_null($last_assistance)) {
           EntranceExit::create([
                'id_person' => $person->id,
                'date_time' => now(),
                'action' => $action
            ]);
        //si se está tomando asistencia un día diferente de la ultima asistencia, se registra entrada
        }elseif ($last_assistance->date_time->day != now()->day){
            EntranceExit::create([
                'id_person' => $person->id,
                'date_time' => now(),
                'action' => $action
            ]);
            //si se está tomando el mismo día y el ultimo registro fue entrada, se registrará salida
        }elseif($last_assistance->action == "entrada"){
            $action = "salida";
            EntranceExit::create([
                'id_person' => $person->id,
                'date_time' => now(),
                'action' => $action
            ]);
        }else{
            EntranceExit::create([
                'id_person' => $person->id,
                'date_time' => now(),
                'action' => $action
            ]);
        }

        //Se toma la posición de la persona
        $position = $person->position->position;

         return response()->json([
            'action' => $action,
            'position' => $position,
            'name' => $person->name
        ]);
    }
}

//se toma la asistencia con la tabla personas

//se mira los datos de uno como usuario