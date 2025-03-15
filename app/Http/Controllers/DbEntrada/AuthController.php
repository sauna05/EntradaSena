<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
use App\Models\DbEntrada\EntranceExit;
use App\Models\DbEntrada\Person;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request){

        $data = $request->validate([
            'user_name'=> 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($data)){
            $user = Auth::user();
            $request->session()->regenerate();
            Auth::shouldUse('web');

            if($user->hasRole('Administrador')){

                return redirect()->route('entrance.people.index');

            }else if($user->hasRole('Acceso-Entrada')){

                return redirect()->route('entrance.create');
                
            }else if($user->hasRole('Aprendiz')){
                
                return redirect()->route('apprentice.show', ['id' => $user->id]);
           
            }           

        }else{
            return redirect()->route('login')->withErrors([
                'entrance.user_name' => 'Las credenciales proporcionadas son incorrectas.'
            ])->withInput();
            
           
        }
    
}

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
  
}
