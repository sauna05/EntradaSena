<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
use App\Models\DbEntrada\Person;
use App\Models\DbEntrada\Position;
use App\Models\DbEntrada\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class EntranceAdminController extends Controller
{
    public function peopleIndex()
    {
        return view('pages.entrance.admin.people_index');
    }

    public function peopleCreate(){
        $positions = Position::pluck('position','id');
        return view('pages.entrance.admin.people_create',['positions'=> $positions]);
    }

    public function peopleStore(Request $request){

        //Creacion de la persona
        $data = $request->validate([
           'id_position' => 'required',
           'document_number' => 'required',
           'name' => 'required',
           'start_date' => 'required',
           'end_date' => 'required'
        ]);
        //Si ya la persona se registró, cancelar
        if(Person::where('document_number',$data['document_number'])->exists()){
            return redirect()->route('entrance.people.index')->with('message', 'Ya existe una persona en el centro con este numero de documento');
        }

        $person = Person::create($data);
        //Creacion del usuario si es aprendiz
        if(trim($person->position->position) === 'Aprendiz'){
                $user = User::create([
                'id_person' => $person->id,
                'user_name' => $person->document_number,
                'password' => bcrypt($person->document_number)
            ]);
            $user->assignRole('Aprendiz');
        }
        
        return redirect()->route('entrance.people.index')->with('message','Persona Registrada Correctamente');
        

    }

    public function storePeopleExcel(){
        return response()->json(['success' => true, 'message' => 'Datos recibidos correctamente']);
        
    }
}
