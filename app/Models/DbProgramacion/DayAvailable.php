<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Model;

class DayAvailable extends Model
{
    protected $connection = 'db_programacion';

    protected $table = 'days_available';

    protected $fillable = ['day'];

    //Un día está asociado a varias personas
    public function people()
    {
        return $this->belongsToMany(Person::class, 'people_days_available', 'id_day_available', 'id_person');
    }

    public function peopleDay_available()
    {
        return $this->hasMany(People_days_available::class, 'id_day_available');
    }
}
