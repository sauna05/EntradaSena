<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'specialities';
    protected $guarded = [];

    //Añadir modelo de instructores
    public function instructors()
    {
        return $this->hasMany(Instructor::class);
    }
    public function competencies()
    {
        return $this->hasMany(Competencies::class);
    }

}
