<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\InstructorStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InstructorStatus::create([
            "name" => "Activo"
        ]);
        InstructorStatus::create([
            "name" => "Inactivo"
        ]);
    }
}
