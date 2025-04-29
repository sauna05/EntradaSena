<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'programs';
    protected $guarded = [];

    public function Program_Level()
    {
        return $this->hasMany(Program_Level::class);
    }



}
