<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CompetencieInstructor extends Pivot
{
    //
    protected $table = 'instructor_competencie';
    protected $connection = 'db_programacion';

    public $incrementing = false;

    protected $fillable = [
        'competence_id',
        'instructor_id',

    ];
}

