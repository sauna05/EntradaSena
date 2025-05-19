<?php
namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ApprenticeCohort extends Pivot
{
    protected $table = 'apprentices_cohorts';
    protected $connection = 'db_programacion';

    protected $fillable = [
        'id_apprentice',
        'id_cohort',
        // Puedes agregar más campos si existen (ej. 'assigned_at')
    ];

   
}

