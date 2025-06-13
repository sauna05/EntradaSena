<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{

    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'instructors';
    protected $guarded = [];

    public function person()
    {
        return $this->belongsTo(Person::class, 'id_person');
    }
    
    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'id_speciality');
    }


    public function Cohort()
    {
        return $this->hasMany(Cohort::class);
    }



    public function competencies()
    {
        return $this->belongsToMany(Competencies::class, 'instructor_competencie', 'instructor_id', 'competence_id')
            ->using(CompetencieInstructor::class);
    }

    //

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
