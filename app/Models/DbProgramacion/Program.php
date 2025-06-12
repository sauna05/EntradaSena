<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //

    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'programs';
    protected $guarded = [];

    public function Program_Level()
    {
        return $this->hasMany(Program_Level::class);
    }

    public function Cohort()
    {
        return $this->hasMany(Cohort::class);
    }



   public function competencies()
    {
        return $this->belongsToMany(Competencies::class, 'competencies_programs', 'id_program', 'id_competence')
            ->using(CompetenciePrograman::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }



}

