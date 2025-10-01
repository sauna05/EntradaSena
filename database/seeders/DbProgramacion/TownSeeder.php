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
        $municipios = [
            "Fonseca",
            "Albania",
            "Barrancas",
            "Dibulla",
            "Distracción",
            "El Molino",
            "Hatonuevo",
            "La Jagua del Pilar",
            "Maicao",
            "Manaure",
            "Riohacha", // Capital del departamento
            "San Juan del Cesar",
            "Uribia",
            "Urumita",
            "Villanueva"
        ];

        foreach ($municipios as $municipio) {
            Town::firstOrCreate([
                "name" => $municipio
            ]);
        }
    }
}
