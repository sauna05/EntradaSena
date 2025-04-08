<?php

namespace App\Models\DbEntrada;

use Illuminate\Database\Eloquent\Model;

class EventLog extends Model
{
    protected $connection = 'db_entrada';

    protected $table = 'events_log';

    protected $fillable = [
        'name',
        'executed_at',
    ];

    public $timestamps = false;
}
