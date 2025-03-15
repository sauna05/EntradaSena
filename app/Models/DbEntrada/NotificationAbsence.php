<?php

namespace App\Models\DbEntrada;

use Illuminate\Database\Eloquent\Model;

class NotificationAbsence extends Model
{
    protected $connection = 'db_entrada';
    protected $table = 'notifications_absences';
    protected $guarded = [];

    public function person()
    {
        return $this->belongsTo(Person::class,"id_person");
    }
}
