<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function error(){
        return view('pages.error_page');
    }

     public function showChangeForm()
     {
         return view('pages.entrance.apprentice.apprentice_changePassword');
     }
 
     public function changePassword(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'current_password' => 'required',
             'new_password' => 'required|confirmed', 
         ]);
 
         if ($validator->fails()) {
             return redirect()->route('password.change')
                 ->withErrors($validator)
                 ->withInput();
         }
 
         if (!Hash::check($request->current_password, Auth::user()->password)) {
             return redirect()->route('password.change')
                 ->withErrors(['current_password' => 'La contraseña actual es incorrecta.'])
                 ->withInput();
         }
 
         $user = Auth::user();
         $user->password = Hash::make($request->new_password);
         $user->save();
 
         return redirect()->route('apprentice.show', ['id' => $user->id])
             ->with('success', 'Contraseña cambiada exitosamente.');
     }
}
