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
        $blocks = [
            'Casa Blanca',
            'B1',
            'B4',
            'B6',
            'B7',
            'B8',
            'B9',
            'B2',
            'Bilinguismo',
            'Comegenes',
            'Bobino',
            'Biblioteca',
            'Acuicola',
            'General',
            'Villa Campo Alegre',
            'Alcaldia',
            'Creem',
            'A',
            'Virtual'
        ];

        foreach ($blocks as $block) {
            Block::firstOrCreate(['name' => $block]);
        }
    }
}
