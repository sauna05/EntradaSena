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
            "name" => "Análisis y Desarrollo de Software"
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0002",
            "program_version" => "1",
            "name" => "Gestión de Redes"
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0003",
            "program_version" => "2",
            "name" => "Sistemas de Información"
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0004",
            "program_version" => "1",
            "name" => "Desarrollo de Aplicaciones Móviles"
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0005",
            "program_version" => "3",
            "name" => "Ciberseguridad"
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0006",
            "program_version" => "1",
            "name" => "Big Data y Análisis de Datos"
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0007",
            "program_version" => "2",
            "name" => "Inteligencia Artificial"
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0008",
            "program_version" => "1",
            "name" => "Desarrollo Web"
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0009",
            "program_version" => "2",
            "name" => "Automatización de Procesos"
        ]);

        Program::create([
            "id_level" => 2,
            "program_code" => "T0010",
            "program_version" => "1",
            "name" => "Diseño de Videojuegos"
        ]);

        // Programas de nivel 1 (Técnico)
        Program::create([
            "id_level" => 1,
            "program_code" => "P0011",
            "program_version" => "1",
            "name" => "Gestión Empresarial"
        ]);

        Program::create([
            "id_level" => 1,
            "program_code" => "P0012",
            "program_version" => "2",
            "name" => "Técnico en Contabilidad"
        ]);

        Program::create([
            "id_level" => 1,
            "program_code" => "P0013",
            "program_version" => "3",
            "name" => "Secretariado Administrativo"
        ]);

        Program::create([
            "id_level" => 1,
            "program_code" => "P0014",
            "program_version" => "1",
            "name" => "Técnico en Cocina"
        ]);

        Program::create([
            "id_level" => 1,
            "program_code" => "P0015",
            "program_version" => "2",
            "name" => "Técnico en Diseño Gráfico"
        ]);

        Program::create([
            "id_level" => 1,
            "program_code" => "P0016",
            "program_version" => "3",
            "name" => "Técnico en Carpintería"
        ]);

        Program::create([
            "id_level" => 1,
            "program_code" => "P0017",
            "program_version" => "1",
            "name" => "Técnico en Refrigeración"
        ]);

        Program::create([
            "id_level" => 1,
            "program_code" => "P0018",
            "program_version" => "2",
            "name" => "Técnico en Mantenimiento de Equipos"
        ]);

        Program::create([
            "id_level" => 1,
            "program_code" => "P0019",
            "program_version" => "1",
            "name" => "Técnico en Gestión de Calidad"
        ]);

        Program::create([
            "id_level" => 1,
            "program_code" => "P0020",
            "program_version" => "2",
            "name" => "Técnico en Electricidad"
        ]);
    }
}
