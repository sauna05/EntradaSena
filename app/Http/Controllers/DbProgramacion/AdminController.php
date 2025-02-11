<?php

namespace App\Http\Controllers\DbProgramacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('pages.programming.programming_dashboard');
    }
}
