<?php

namespace App\Http\Controllers\DbProgramacion;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\Program;
use App\Models\DbProgramacion\Program_Level;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $programs = Program::all();
        $programan_level = Program_Level::all();
        return view('pages.programming.Admin.programming_dashboard', compact('programs', 'programan_level'));
    }
}
