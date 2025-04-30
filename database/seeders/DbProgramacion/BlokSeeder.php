<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Block;
use Illuminate\Database\Seeder;

class BlokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 30 bloques con nombres "bloque A", "bloque B", ..., "bloque AD"
        $letters = range('A', 'Z'); // 26 letras
        $blocksCount = 30;

        for ($i = 0; $i < $blocksCount; $i++) {
            // Para nombres después de Z, combinamos letras (AA, AB, AC, AD)
            if ($i < 26) {
                $name = "bloque " . $letters[$i];
            } else {
                $first = $letters[intval(($i - 26) / 26)];
                $second = $letters[($i - 26) % 26];
                $name = "bloque " . $first . $second;
            }

            Block::create([
                'name' => $name,
            ]);
        }
    }
}
