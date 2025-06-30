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
    public function programming()
    {
        return $this->hasMany(Programming::class, 'id_instructor');
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'id_speciality');
    }

    //estado de instructor

    public function instructor_status(){
        return $this->belongsTo(InstructorStatus::class, 'id_status');
    }

    public function link_types()
    {
        return $this->belongsTo(LinkType::class, 'id_link_type');
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
