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
        $programs = Program::orderBy('created_at', 'desc')->paginate(10);
        $programan_level = Program_Level::all();

        return view('pages.programming.Admin.programming_dashboard', [
            'programs' => $programs,
            'programan_level' => $programan_level
        ]);
    }
}
