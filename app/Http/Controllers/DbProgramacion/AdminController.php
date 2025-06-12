<?php

namespace App\Http\Controllers\DbProgramacion;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\Instructor;
use App\Models\DbProgramacion\Program;
use App\Models\DbProgramacion\Program_Level;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $programs = Program::orderBy('created_at', 'desc')->paginate(10);
        $programan_level = Program_Level::all();
        $instructors=Instructor::with('person')->get();

        return view('pages.programming.Admin.programming_dashboard',compact('programs', 'instructors', 'programan_level'));
    }
}
