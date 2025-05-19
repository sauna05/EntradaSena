<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competencies extends Model
{
    //
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'competencies';
    protected $guarded = [];

    
}
