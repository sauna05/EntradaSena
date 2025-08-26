<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    use HasFactory;
    protected $table = 'cohorts';
    protected $connection = 'db_programacion';

    protected $fillable = [
        'number_cohort',
        'id_program',
        'id_time',
        'id_town',
        'start_date',
        'end_date',
        'enrolled_quantity',
    ];

    public function programmings()
    {
        return $this->hasMany(Programming::class, 'id_cohort');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'id_program');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'id_instructor');
    }

    public function cohortime()
    {
        return $this->belongsTo(CohorTime::class, 'id_time');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'id_classroom');
    }

    public function town()
    {
        return $this->belongsTo(Town::class, 'id_town');
    }

    public function apprentices()
    {
        return $this->belongsToMany(Apprentice::class, 'apprentices_cohorts', 'id_cohort', 'id_apprentice')
                    ->using(ApprenticeCohort::class);
    }

    public function competences()
    {
        return $this->belongsToMany(
            Competencies::class,
            'competencies_cohorts',
            'cohort_id',
            'competence_id'
        )->using(Competencies_cohort::class);
    }


}
