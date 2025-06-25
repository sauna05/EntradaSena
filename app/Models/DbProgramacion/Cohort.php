<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    //
    use HasFactory;
    protected $table = 'cohorts'; // o el nombre que uses

    protected $connection = 'db_programacion';

    protected $fillable = [
        'number_cohort',
        'id_program',

        'id_time',

        'id_town',
        'hours_school_stage',
        'hours_practical_stage',
        'start_date_school_stage',
        'end_date_school_stage',
        'start_date_practical_stage',
        'end_date_practical_stage',
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
                    ->using(ApprenticeCohort::class); // 💡 Relación con modelo pivote
    }


}
