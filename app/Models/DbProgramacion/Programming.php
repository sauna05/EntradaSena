<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programming extends Model
{
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'programming';
    protected $guarded = [];

    // Relación con Cohort (ficha)
    public function cohort()
    {
        return $this->belongsTo(Cohort::class, 'id_cohort');
    }

    // Relación con Instructor
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'id_instructor');
    }

    // Relación con Competence
    public function competencie()
    {
        return $this->belongsTo(Competencies::class, 'id_competencie');
    }

    // Relación con Classroom (ambiente)
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'id_classroom');
    }

    // Relación muchos a muchos con Day (días de la semana)
    public function days()
    {
        return $this->belongsToMany(Day::class, 'programming_day', 'programming_id', 'day_id');
    }
}
