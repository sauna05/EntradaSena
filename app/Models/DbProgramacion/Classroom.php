<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'classrooms';
    protected $guarded = [];

    public function Block()
    {
        return $this->belongsTo(Block::class, 'id_block');
    }

    public function Towns()
    {
        return $this->belongsTo(Town::class, 'id_town');
    }

    public function Cohort()
    {
        return $this->hasMany(Cohort::class);
    }

    public function programming()
    {
        return $this->hasMany(Programming::class, 'id_classroom');
    }
}
