<?php

namespace App\Http\Controllers\DbEntrada;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DbEntrada\Person;
use App\Models\DbEntrada\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class ApprenticeController extends Controller
{
    public function index(){

        return "holi";

    }
    

public function show($id)
{
        $user = DB::table('users')->where('id', $id)->first();
    if (!$user) {
        abort(404, "Usuario no encontrado");
    }
    $person = DB::table('people')->where('document_number', $user->user_name)->first();

    return view('pages.entrance.apprentice.apprentice_index', compact('user', 'person'));
}

public function showChangePasswordForm()
{
    return view('pages.entrance.apprentice.change_password');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'new_password' => ['required', 'confirmed', Password::min(8)],
    ]);

    $user = Auth::user();

    if (!$user) {
        abort(404, "Usuario no encontrado");
    }

    // Actualizar la contraseña
    $user->update([
        'password' => Hash::make($request->new_password)
    ]);

    return redirect()->route('password.change')->with('success', '¡Contraseña actualizada correctamente!');
}

}