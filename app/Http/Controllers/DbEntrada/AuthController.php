<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
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
                
           
            }           

        }else{
            return "USUARIO NO ENCONTRADO"; // (IMPORTANTE) en un futuro, hacer que envíe al login con
            // mensaje de error de que el usuario no existe
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
  
}
