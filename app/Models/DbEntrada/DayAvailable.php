<?php

namespace App\Models\DbEntrada;

use Illuminate\Database\Eloquent\Model;

class DayAvailable extends Model
{
    protected $connection = 'db_entrada';

    protected $table = 'days_available';

    protected $fillable = ['day'];

    //Un día está asociado a varias personas
    public function people(){
        return $this->belongsToMany(Person::class,'people_days_available','id_day_available','id_person');
    }
}
