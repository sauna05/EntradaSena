<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'towns';
    protected $guarded = [];

    public function people()
    {
        return $this->hasMany(Person::class);
    }

    public function classroom()
    {
        return $this->hasMany(Classroom::class);
    }

    public function Cohort()
    {
        return $this->hasMany(Cohort::class);
    }
}
