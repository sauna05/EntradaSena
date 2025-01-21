<?php

namespace App\Models\DbEntrada;

use Illuminate\Database\Eloquent\Model;

class EntranceExit extends Model
{
    protected $connection = 'db_entrada';
    protected $table = 'entrances_exits';
    protected $guarded = [];

    public function people(){
        return $this->belongsTo(Person::class);
    }
}
