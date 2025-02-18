<?php

namespace App\Models\DbEntrada;

use Illuminate\Database\Eloquent\Model;

class EntranceExit extends Model
{
    protected $connection = 'db_entrada';
    protected $table = 'entrances_exits';
    protected $guarded = [];

    //Para que siempre me trate las fechas como formato 
    //carbon y pueda ejecutar metodos que me facilitan la vida con las fechas :P
    protected $dates = ['date_time'];

    protected $casts =[
        'date_time' => 'datetime'
    ];
    
    public function people(){
        return $this->belongsTo(Person::class, 'id_person');
    }
}
