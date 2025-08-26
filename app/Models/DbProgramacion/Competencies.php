<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competencies extends Model
{
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'competencies';
    protected $guarded = [];

    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }

    public function instructors()
    {
        return $this->belongsToMany(
            Instructor::class,
            'instructor_competencie',
            'competence_id',
            'instructor_id'
        )->using(CompetencieInstructor::class);
    }



        public function cohorts()
        {
            return $this->belongsToMany(
                Cohort::class,
                'competencies_cohorts',
                'competence_id',
                'cohort_id'
            )->using(Competencies_cohort::class);
        }

}
