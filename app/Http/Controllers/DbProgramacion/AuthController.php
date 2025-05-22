<?php

namespace App\Http\Controllers\DbProgramacion;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\Program;
use App\Models\DbProgramacion\Program_Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

        public function login(Request $request)
        {
            $request->validate([
                'user_name' => 'required',
                'password' => 'required',
                'module' => 'required|in:Administrador_programacion,Administrador_asistencia',
            ]);

            // Solo se pasan las credenciales válidas al Auth
            $credentials = $request->only('user_name', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $selectedRole = $request->input('module');

                if ($user->hasRole($selectedRole)) {
                    // Redirección según el módulo seleccionado
                    if ($selectedRole === 'Administrador_programacion') {
                        return redirect()->route('programming.admin');
                    } elseif ($selectedRole === 'Administrador_asistencia') {
                        return redirect()->route('entrance.people.index');
                    }
                } else {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return redirect()->route('login')->withErrors([
                        'programming.user_name' => 'No tienes permisos para el módulo seleccionado.'
                    ]);
                }

            } else {
                return redirect()->route('login')->withErrors([
                    'programming.user_name' => 'Las credenciales proporcionadas son incorrectas.'
                ])->withInput();
            }
        }


        public function dashboard()
        {
            $programs = Program::all();
            $programan_level = Program_Level::all();
            return view('pages.programming.Admin.programming_dashboard', compact('programs', 'programan_level'));
        }


}
