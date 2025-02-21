<?php

namespace Database\Seeders\DbEntrada;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DayAvailable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::connection('db_entrada')->table('days_available')->insert([
        ['day' => 'Lunes', 'day_english' => 'Monday', 'created_at' => now(), 'updated_at' => now()],
        ['day' => 'Martes','day_english' => 'Tuesday', 'created_at' => now(), 'updated_at' => now()],
        ['day' => 'Miércoles','day_english' => 'Wednesday', 'created_at' => now(), 'updated_at' => now()],
        ['day' => 'Jueves','day_english' => 'Thursday', 'created_at' => now(), 'updated_at' => now()],
        ['day' => 'Viernes','day_english' => 'Friday', 'created_at' => now(), 'updated_at' => now()],
        ['day' => 'Sábado','day_english' => 'Saturday', 'created_at' => now(), 'updated_at' => now()],
        ['day' => 'Domingo','day_english' => 'Sunday', 'created_at' => now(), 'updated_at' => now()],

       ]);
    }
}
