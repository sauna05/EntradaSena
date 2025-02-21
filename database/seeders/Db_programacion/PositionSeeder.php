<?php

namespace Database\Seeders\Db_programacion;

use App\Models\DbProgramacion\Position;
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
            'position' => 'Coordinador'
        ]);
        Position::create([
            'position' => 'Administrativo'
        ]);

        Position::create([
            'position' => 'Aprendiz'
        ]);

        Position::create([
            'position' => 'Instructor de Planta'
        ]);

        Position::create([
            'position' => 'Instructor Contratista'
        ]);

    }
}
