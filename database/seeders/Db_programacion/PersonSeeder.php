<?php

namespace Database\Seeders\Db_programacion;

use App\Models\DbProgramacion\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Person::create([
            'id_position' => 1,
            'id_town' => 1,
            'document_number' => '1111111111',
            'name' => 'Marlon Saenz',
            'start_date' => '2024-12-4',
            'end_date' => '2030-12-24',
            'created_at' => now(),
            'updated_at' => now()
        ]);    }
}
