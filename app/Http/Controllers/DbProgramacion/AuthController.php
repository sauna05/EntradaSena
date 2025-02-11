<?php

namespace App\Http\Controllers\DbProgramacion;

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

            if($user->hasRole('Administrador')){

                return redirect()->route('programming.admin');

            }
            // else if($user->hasRole('Aprendiz')){
            // //Cierra la sesión en caso de ser aprendiz
            //     Auth::logout();

            //     $request->session()->invalidate();
            //     $request->session()->regenerateToken();
            //     return redirect()->route('login');
            // }
            
        }else{
            return "Andate de aqui, hacker()";
        }

    }

    
}
