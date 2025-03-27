<?php

namespace Database\Seeders\DbEntrada;

use App\Models\DbEntrada\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::create([
            'name' => 'Coordinador'
        ]);
        Position::create([
            'name' => 'Administrativo'
        ]);

        Position::create([
            'name' => 'Aprendiz'
        ]);


        Position::create([
            'name' => 'Instructor'
        ]);

        Position::create([
            'name' => 'Visitante'
        ]);

    }
}
