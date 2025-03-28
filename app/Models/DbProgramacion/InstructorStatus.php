<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorStatus extends Model
{
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'instructors_status';
    protected $guarded = [];

    public function instructors()
    {
        return $this->hasMany(Instructor::class);
    }
}
