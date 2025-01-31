<?php

namespace App\Models\DbEntrada;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $connection = 'db_entrada';
    protected $table = 'positions';
    protected $guarded = [];

    public function people(){
        return $this->hasMany(Person::class);
    }
}
