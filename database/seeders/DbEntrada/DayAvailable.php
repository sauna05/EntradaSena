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
        ['day' => 'Lunes','created_at' => now(), 'updated_at' => now()],
        ['day' => 'Martes','created_at' => now(), 'updated_at' => now()],
        ['day' => 'Miercoles', 'created_at' => now(), 'updated_at' => now()],
        ['day' => 'Jueves','created_at' => now(), 'updated_at' => now()],
        ['day' => 'Viernes','created_at' => now(), 'updated_at' => now()],
        ['day' => 'Sabado', 'created_at' => now(), 'updated_at' => now()],
        ['day' => 'Domingo', 'created_at' => now(), 'updated_at' => now()],

       ]);
    }
}
