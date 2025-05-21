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




    public function programs()
    {
        return $this->belongsToMany(Program::class, 'competencies_programs', 'id_competence', 'id_program')
            ->using(CompetenciePrograman::class);
    }



}
