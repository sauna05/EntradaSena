<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{

    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'instructors';
    protected $guarded = [];

    public function person()
    {
        return $this->hasMany(Person::class);
    }
}
