<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Classroom;
use Illuminate\Database\Seeder;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 20 aulas con nombres "aula tic 1", "aula tic 2", ..., "aula tic 20"
        // Asumo que id_town y id_block pueden variar entre algunos valores de ejemplo

        $towns = [1, 2, 3, 4, 5];    // Ejemplo de id_town disponibles
        $blocks = range(1, 10);      // Ejemplo de id_block disponibles

        for ($i = 1; $i <= 20; $i++) {
            Classroom::create([
                'id_town' => $towns[array_rand($towns)],
                'id_block' => $blocks[array_rand($blocks)],
                'name' => "aula tic $i",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
