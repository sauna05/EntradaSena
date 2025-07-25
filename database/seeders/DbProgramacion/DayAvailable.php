<?php

namespace Database\Seeders\DbProgramacion;

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
       DB::connection('db_programacion')->table('days_available')->insert([
        ['name' => 'Lunes', 'name_english' => 'Monday', 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Martes', 'name_english' => 'Tuesday', 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Miércoles', 'name_english' => 'Wednesday', 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Jueves', 'name_english' => 'Thursday', 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Viernes', 'name_english' => 'Friday', 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Sábado', 'name_english' => 'Saturday', 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Domingo', 'name_english' => 'Sunday', 'created_at' => now(), 'updated_at' => now()],

       ]);
    }
}
