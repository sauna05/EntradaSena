<?php

namespace App\Models\DbEntrada;

use Illuminate\Database\Eloquent\Model;

class DayAvailable extends Model
{
    protected $connection = 'db_entrada';

    protected $table = 'days_available';

    protected $fillable = ['day'];
}
