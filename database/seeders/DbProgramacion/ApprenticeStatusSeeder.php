<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\ApprenticeStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApprenticeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ApprenticeStatus::create([
            "name" => "En Formación"
        ]);
        ApprenticeStatus::create([
            "name" => "Cancelado"
        ]);
        ApprenticeStatus::create([
            "name" => "Retiro Voluntario"
        ]);

        ApprenticeStatus::create([
            "name" => "Aplazado"
        ]);
    }
}
