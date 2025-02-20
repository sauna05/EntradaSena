<?php

use App\Http\Controllers\DbEntrada\ApprenticeController;
use App\Http\Controllers\DbEntrada\AuthController as EntranceAuthController;
use App\Http\Controllers\DbEntrada\EntranceAdminController;
use App\Http\Controllers\DbEntrada\EntranceExitController;
use App\Http\Controllers\DbEntrada\UserController;
use App\Http\Controllers\DbProgramacion\AdminController as ProgrammingAdminController;
use App\Http\Controllers\DbProgramacion\AuthController as ProgrammingAuthController;
use App\Models\DbEntrada\User;
use Illuminate\Support\Facades\Route;
//Pagina inicial
Route::get('/', function () {return view('pages.start_page'); })->name('login');
//Logout universal
Route::post('logout', [EntranceAuthController::class, 'logout'])->name('logout');

//Entrada ------------------------------------------------------------------------------

//login
Route::post('entrance/login',[EntranceAuthController::class,'login'])->name('entrance-login');

//Modulo Entrada
Route::get('/entrance',[EntranceExitController::class,  'create'])->middleware('can:entrance.create')->name('entrance.create');
Route::post('/entrance/store',[EntranceExitController::class, 'store'])->middleware('can:entrance.store')->name('entrance.store');

//Modulo Entrada - Administrador
//Primera vista del administrador
Route::get('entrance/admin/people',[EntranceAdminController::class, 'peopleIndex']) ->middleware('can:entrance.people.index')->name('entrance.people.index');
Route::get('entrance/admin/people/create',[EntranceAdminController::class,'peopleCreate'])->middleware('can:entrance.people.create')->name('entrance.people.create');
Route::post('entrance/admin/people/store', [EntranceAdminController::class, 'peopleStore'])->middleware('can:entrance.people.store')->name('entrance.people.store');
Route::get('entrance/admin/people/{id}', [EntranceAdminController::class, 'peopleShow'])->middleware('can:entrance.people.show')->name('entrance.people.show');

Route::post('/entrance/upload/excel/people', [EntranceAdminController::class, 'storePeopleExcel'])->middleware('can:entrance.excel.upload')->name('entrance.excel.upload');

//Modulo Entrada - Aprendiz
Route::get('entrance/apprentice/{id}',[ApprenticeController::class, 'show']) ->name('apprentice.show');
// Ruta para cambiar la contraseña
Route::get('/password', [UserController::class, 'showChangeForm'])->name('password.change');
Route::post('/changePassword', [UserController::class, 'changePassword'])->name('password.update');


//Programación ------------------------------------------------------------------------

//login
Route::post('programming/login', [ProgrammingAuthController::class, 'login'])->name('programming-login');

//Modulo Programación
Route::get('programming/admin', [ProgrammingAdminController::class, 'dashboard'])->middleware('can:programming.admin')->name('programming.admin');

