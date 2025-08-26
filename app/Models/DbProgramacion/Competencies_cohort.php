<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Competencies_cohort extends Pivot
{
    protected $table = 'competencies_cohorts';
    protected $connection = 'db_programacion';

    public $incrementing = false;

    protected $fillable = [
        'cohort_id',
        'competence_id',
    ];
}

