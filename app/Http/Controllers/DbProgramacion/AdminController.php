<?php

namespace App\Http\Controllers\DbProgramacion;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\Program;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $programs=Program::all();
        return view('pages.programming.Admin.programming_dashboard',compact('programs'));
    }

    
}
