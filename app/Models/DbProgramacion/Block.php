<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    //
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'blocks';
    protected $guarded = [];


    public function Classroom(){
        return $this->hasMany(Classroom::class);
    }
    

}
