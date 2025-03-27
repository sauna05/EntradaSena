<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Speciality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Speciality::create([
            "name" => "Ingeniería de Sistemas"
        ]);
        Speciality::create([
            "name" => "Administración de Empresas"
        ]);
        Speciality::create([
            "name" => 'Contaduría Pública'
        ]);
        Speciality::create([
            "name" => 'Psicología'
        ]);
        Speciality::create([
            "name" => 'Diseño Gráfico'
        ]);
        Speciality::create([
            "name" => 'Medicina'
        ]);
        Speciality::create([
            "name" => 'Arquitectura'
        ]);
        Speciality::create([
            "name" => 'Derecho'
        ]);
        Speciality::create([
            "name" => 'Ingeniería Electrónica'
        ]);
        Speciality::create([
            "name" => 'Marketing Digital'
        ]);

    }
}
