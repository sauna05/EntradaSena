<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Classroom;
use App\Models\DbProgramacion\Town;
use Illuminate\Database\Seeder;

class ClassRoomSeeder extends Seeder
{
    public function run(): void
    {
        $blocks = range(1, 10);

        // Obtener ID del municipio "Fonseca"
        $id_fonseca = Town::where('name', 'Fonseca')->value('id');

        // Obtener IDs de otros municipios diferentes a Fonseca
        $otros_municipios = Town::where('name', '!=', 'Fonseca')->pluck('id')->toArray();

        // 1. Crear 20 ambientes en Fonseca
        for ($i = 1; $i <= 20; $i++) {
            Classroom::create([
                'id_town' => $id_fonseca,
                'id_block' => $blocks[array_rand($blocks)],
                'name' => "aula tic $i",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 2. Crear 10 ambientes en otros municipios
        for ($i = 21; $i <= 30; $i++) {
            Classroom::create([
                'id_town' => $otros_municipios[array_rand($otros_municipios)],
                'id_block' => $blocks[array_rand($blocks)],
                'name' => "aula tic $i",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
