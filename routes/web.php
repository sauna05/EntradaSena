<?php

use App\Http\Controllers\DbEntrada\UserController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.start_page');
});


Route::get('error',[UserController::class,'error']);
