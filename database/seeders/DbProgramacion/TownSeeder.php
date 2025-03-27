<?php

namespace Database\Seeders\DbProgramacion;

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
            "name"=> "Fonseca"
        ]);

        Town::create([
            "name" => "Distracción"
        ]);

        Town::create([
            "name" => "Barrancas"
        ]);

        Town::create([
            "name" => "Hatonuevo"
        ]);

        Town::create([
            "name" => "San Juan del Cesar"
        ]);

        Town::create([
            "name" => "Riohacha"
        ]);
    }
}
