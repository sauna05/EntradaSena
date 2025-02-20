<?php

namespace Database\Seeders\Db_programacion;

use App\Models\DbProgramacion\Town;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Town::create([
            "town"=> "Fonseca"
        ]);

        Town::create([
            "town" => "Distracción"
        ]);

        Town::create([
            "town" => "Barrancas"
        ]);

        Town::create([
            "town" => "Hatonuevo"
        ]);

        Town::create([
            "town" => "San Juan del Cesar"
        ]);

        Town::create([
            "town" => "Riohacha"
        ]);
    }
}
