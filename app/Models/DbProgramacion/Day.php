<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    //
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'days';
    protected $guarded = [];



   public function days()
    {
        return $this->belongsToMany(Day::class, 'days_programing', 'programming_id', 'day_id');
    }



}
