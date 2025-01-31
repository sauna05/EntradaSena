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
                return view('pages.programming.programming');
            }else if($user->hasRole('Aprendiz')){
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login');

            }
        }else{
            dd("Andate de aqui, hacker");
        }

    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');

    }
}
