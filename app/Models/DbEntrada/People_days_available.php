<?php

namespace App\Models\DbEntrada;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class People_days_available extends Model
{
    //
    use HasFactory;
    use Notifiable;

    protected $connection = 'db_entrada';
    protected $table = 'people_days_available';
    protected $guarded = [];


    public function days_available()
    {
        return $this->belongsTo(DayAvailable::class, 'id_day_available');
    }

    //Una persona tiene muchas entradas y salidas
    public function person()
    {
        return $this->hasMany(person::class, 'id_person');
    }
}
