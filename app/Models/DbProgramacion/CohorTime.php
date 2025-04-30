<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CohorTime extends Model
{
    //
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'cohort_time';
    protected $guarded = [];

    public function person()
    {
        return $this->hasMany(Person::class);
    }
}
