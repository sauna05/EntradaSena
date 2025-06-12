<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Programas de nivel 2 (Tecnólogo)
        Program::create([
            "id_level" => 2,
            "program_code" => "T0001",
            "program_version" => "1",
            "name" => "Análisis y Desarrollo de Software",
            "instructor_id"=>1
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0002",
            "program_version" => "1",
            "name" => "Gestión de Redes",
            "instructor_id"=>1
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0003",
            "program_version" => "2",
            "name" => "Sistemas de Información",
            "instructor_id" => 1
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0004",
            "program_version" => "1",
            "name" => "Desarrollo de Aplicaciones Móviles",
            "instructor_id" => 2
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0005",
            "program_version" => "3",
            "name" => "Ciberseguridad",
            "instructor_id" => 1
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0006",
            "program_version" => "1",
            "name" => "Big Data y Análisis de Datos",
            "instructor_id" => 3
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0007",
            "program_version" => "2",
            "name" => "Inteligencia Artificial",
            "instructor_id" => 2
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0008",
            "program_version" => "1",
            "name" => "Desarrollo Web",
            "instructor_id" => 1
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0009",
            "program_version" => "2",
            "name" => "Automatización de Procesos",
            "instructor_id" => 2
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0010",
            "program_version" => "1",
            "name" => "Diseño de Videojuegos",
            "instructor_id" => 3
        ]);

    
       

       
    }
}
