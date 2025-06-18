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
        // Programas de nivel 2 (Tecnólogo) - Diversificados
        $diversePrograms = [
            // 1. Tecnología
            [
                "id_level" => 2,
                "program_code" => "T0011",
                "program_version" => "1",
                "name" => "Gestión Logística y Cadena de Suministro",
                "instructor_id" => 2
            ],
            // 2. Gastronomía
            [
                "id_level" => 2,
                "program_code" => "G0001",
                "program_version" => "1",
                "name" => "Gastronomía Internacional y Técnicas Moleculares",
                "instructor_id" => 2
            ],
            // 3. Multimedia
            [
                "id_level" => 2,
                "program_code" => "M0001",
                "program_version" => "1",
                "name" => "Producción Audiovisual y Efectos Digitales",
                "instructor_id" => 2
            ],
            // 4. Administración
            [
                "id_level" => 2,
                "program_code" => "A0001",
                "program_version" => "1",
                "name" => "Gestión de Empresas Creativas",
                "instructor_id" => 2
            ],
            // 5. Salud
            [
                "id_level" => 2,
                "program_code" => "S0001",
                "program_version" => "1",
                "name" => "Biotecnología Alimentaria",
                "instructor_id" => 1
            ],
            // 6. Diseño
            [
                "id_level" => 2,
                "program_code" => "D0001",
                "program_version" => "1",
                "name" => "Diseño de Experiencia de Usuario (UX/UI)",
                "instructor_id" => 1
            ],
            // 7. Comercio
            [
                "id_level" => 2,
                "program_code" => "C0001",
                "program_version" => "1",
                "name" => "Comercio Electrónico y Marketing Digital",
                "instructor_id" => 3
            ],
            // 8. Artes
            [
                "id_level" => 2,
                "program_code" => "R0001",
                "program_version" => "1",
                "name" => "Animación 3D y Arte Digital",
                "instructor_id" => 2
            ],
            // 9. Turismo
            [
                "id_level" => 2,
                "program_code" => "U0001",
                "program_version" => "1",
                "name" => "Gestión de Turismo Sostenible",
                "instructor_id" => 3
            ],
            // 10. Manufactura
            [
                "id_level" => 2,
                "program_code" => "F0001",
                "program_version" => "1",
                "name" => "Diseño de Moda Tecnológica (Wearables)",
                "instructor_id" => 4
            ]
        ];

        // Insertar todos los programas
        foreach ($diversePrograms as $program) {
            Program::create($program);
        }
       

       
    }
}
