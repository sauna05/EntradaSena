<?php

namespace App\Models\DbEntrada;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $connection = 'db_entrada';

    protected $table = 'roles';

    protected $guarded = [];

    public function people(){
        return $this->hasMany(Person::class);
    }
}
