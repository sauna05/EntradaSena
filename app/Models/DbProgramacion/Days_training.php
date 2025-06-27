<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Days_training extends Model
{
    //
    //
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'days_without_training';
    protected $guarded = [];
    
    
}
