<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkType extends Model
{
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'link_types';
    protected $guarded = [];

    public function instructors()
    {
        return $this->hasMany(Instructor::class);
    }
}
