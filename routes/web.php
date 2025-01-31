<?php

use App\Http\Controllers\DbEntrada\AuthController as EntranceAuthController;
use App\Http\Controllers\DbProgramacion\AuthController as ProgrammingAuthController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('pages.start_page'); })->name('login');

Route::post('entrance/login',[EntranceAuthController::class,'login'])->name('entrance-login');
Route::post('entrance/logout',[EntranceAuthController::class,'logout'])->name('entrance-logout');

Route::post('programming/login', [ProgrammingAuthController::class, 'login'])->name('programming-login');
Route::post('programming/logout', [ProgrammingAuthController::class, 'logout'])->name('programming-logout');

