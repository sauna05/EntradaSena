<?php

namespace App\Models\DbEntrada;

use App\Models\DbProgramacion\Person as DbProgramacionPerson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Person extends Model
{
    use HasFactory;
    use Notifiable;

    protected $connection = 'db_entrada';
    protected $table = 'people';
    protected $guarded = [];
    


    //los datos de fecha se convertirán automaticamente en
    //formatos validos para laravel y la base de datos
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];
    //Una persona posee un rol(pertenece a un rol)
    // public function roles(){
    //     return $this->belongsTo(Role::class);
    // }


    //Una persona tiene un cargo
    public function position(){
        return $this->belongsTo(Position::class,'id_position');
    }
    
    //Una persona tiene muchas entradas y salidas
    public function entrances_exits()
    {
        return $this->hasMany(EntranceExit::class, 'id_person'); 
    }

    //Una persona puede tener varios usuarios 
    //(osea, personas con roles diferentes de aprendiz e instructor)
    public function users(){
        return $this->hasMany(User::class);
    }   

    //Los días que puede venir una persona al centro de formación
    public function days_available(){
        return $this->belongsToMany(DayAvailable::class,'people_days_available','id_person','id_day_available');
    }
    //Una persona PUEDE tener varias notificaciones de inasistencia
    public function notifications_absences(){
        return $this->hasMany(NotificationAbsence::class);
    }

    //El correo está en otra base de datos, con esto de obtendrá el correo automaticamnete
    public function routeNotificationForMail()
    {
        return DbProgramacionPerson::where('document_number', $this->document_number)
            ->value('email');
    }


}
