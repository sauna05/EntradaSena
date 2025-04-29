<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program_Level extends Model
{
    //
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'program_level';
    protected $guarded = [];


    public function Program()
    {
        return $this->hasMany(Program::class);
    }
}
