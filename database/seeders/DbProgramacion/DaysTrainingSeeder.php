<?php

namespace Database\Seeders\DbProgramacion;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaysTrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('days_without_training')->insert([
            ['date' => '2025-01-01', 'reason' => 'Año Nuevo'],
            ['date' => '2025-03-24', 'reason' => 'Día de San José'],
            ['date' => '2023-05-01', 'reason' => 'Día del Trabajo'],
            ['date' => '2025-08-07', 'reason' => 'Día Batalla de Boyacá en Colombia'],
            ['date' => '2024-08-07', 'reason' => 'Batalla de Boyacá'],
            // Agrega más fechas si lo deseas...
        ]);
    }
}
