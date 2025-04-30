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

    //Una persona tiene un cargo
    public function position()
    {
        return $this->belongsTo(Position::class, 'id_position');
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
