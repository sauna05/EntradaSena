<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Program_Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramanLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Program_Level::create([
           "name"=> "Técnico",

        ]);
        Program_Level::create([
            "name" => "	Tecnólogo",
        ]);

        Program_Level::create([
            "name" => "Auxiliar"
        ]);
        Program_Level::create([
            "name" => "Operario"
        ]);

    }
}
