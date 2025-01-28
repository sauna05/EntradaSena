<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function error(){
        return view('pages.error_page');
    }
}
