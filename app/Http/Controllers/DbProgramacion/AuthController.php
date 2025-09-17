<?php

namespace App\Http\Controllers\DbProgramacion;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\Classroom;
use App\Models\DbProgramacion\Instructor;
use App\Models\DbProgramacion\Person;
use App\Models\DbProgramacion\Program;
use App\Models\DbProgramacion\Program_Level;
use App\Models\DbProgramacion\Programming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        // Validar campos obligatorios
        $request->validate([
            'user_name' => 'required|string',
            'password'  => 'required|string',
            'module' => 'required|in:Coordinador,Aprendiz',
        ]);

        // Solo se usan las credenciales para la autenticación
        $credentials = $request->only('user_name', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Usar el rol seleccionado desde el formulario
            $selectedRole = $request->module;

            // Verificar si el usuario tiene el rol
            if ($user->hasRole($selectedRole)) {
                // Redirección según el rol
                if ($selectedRole === 'Aprendiz') {
                    // Pasar el ID del usuario autenticado
                    return redirect()->route('apprentice.show', ['id' => $user->id]);
                }

                return redirect()->route('programing.admin_inicio');
            }

            // Si no tiene el rol, cerrar sesión y mostrar error
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors(['login_error' => 'No tienes permisos para el módulo seleccionado.']);
        }

        // Credenciales inválidas
        return redirect()
            ->route('login')
            ->withErrors(['login_error' => 'Las credenciales proporcionadas son incorrectas.'])
            ->withInput($request->only('user_name'));
    }

    public function dashboard()
        {
            //hacer calculos reales de la cantidad de programaciones y demas
            $programaciones = Programming::all();

            $personas = Person::all();
            $instructores = Instructor::with('person')->get();
            $ambientes = Classroom::all();

            return view('pages.programming.Admin.programan.competencies_program_index', compact('programaciones', 'personas', 'ambientes','instructores'));
        }


        //metodo de inicio de la pantalla de programacion
        public function programan_index()
        {
            $programs = Program::with(['instructor.person'])->get();
            $programan_level = Program_Level::all();
            $instructors=Instructor::with('person')->get();
           return view('pages.programming.Admin.programming_dashboard',compact('programs', 'instructors', 'programan_level'));
        }


}
