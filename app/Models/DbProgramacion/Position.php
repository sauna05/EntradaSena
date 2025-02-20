<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'positions';
    protected $guarded = [];


    public function people(){
        return $this->hasMany(Person::class);
    }
}
