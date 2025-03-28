<?php

namespace App\Models\DbProgramacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprenticeStatus extends Model
{
    use HasFactory;
    protected $connection = 'db_programacion';
    protected $table = 'apprentices_status';
    protected $guarded = [];

    public function apprentices()
    {
        return $this->hasMany(Apprentice::class);
    }
}
