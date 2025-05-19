<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apprentice extends Model
{
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'apprentices';
    protected $guarded = [];



    public function person()
    {
        return $this->belongsTo(Person::class, 'id_person');
    }



    public function cohorts()
    {
        return $this->belongsToMany(Cohort::class, 'apprentices_cohorts', 'id_apprentice', 'id_cohort')
                    ->using(ApprenticeCohort::class); // 💡 Relación con modelo pivote
    }

}
