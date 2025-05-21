<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CompetenciePrograman extends Pivot
{
    protected $table = 'competencies_programs';
    protected $connection = 'db_programacion';

    public $incrementing = false; 

    protected $fillable = [
        'id_program',
        'id_competence',

    ];
}
