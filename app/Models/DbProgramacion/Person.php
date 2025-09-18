<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'people';
    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];


    public function People_days_available()
    {
        return $this->hasMany(People_days_available::class, 'id_person');
    }
    public function entrances_exits()
    {
        return $this->hasMany(EntranceExit::class, 'id_person');
    }

    //Los días que puede venir una persona al centro de formación
    public function days_available()
    {
        return $this->belongsToMany(DayAvailable::class, 'people_days_available', 'id_person', 'id_day_available');
    }
    //Una persona PUEDE tener varias notificaciones de inasistencia
    // public function notifications_absences()
    // {
    //     return $this->hasMany(NotificationAbsence::class);
    // }

    //El correo está en otra base de datos, con esto de obtendrá el correo automaticamnete
    // public function routeNotificationForMail()
    // {
    //     return DbProgramacionPerson::where('document_number', $this->document_number)
    //         ->value('email');
    // }


    //Una persona tiene un cargo
    public function position()
    {
        return $this->belongsTo(Position::class, 'id_position');
    }
    public function instructor()
    {
        return $this->hasOne(Instructor::class, 'id_person');
    }


    //Una persona viene de un municipio
    public function town()
    {
        return $this->belongsTo(Town::class, 'id_town');
    }

    public function CohorTime(){
        return $this->belongsTo(CohorTime::class,'id_time');
    }
}
