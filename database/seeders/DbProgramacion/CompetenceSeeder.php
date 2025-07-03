<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Competencies;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $competencies = [
            // Ingeniería de Sistemas (speciality_id = 1)
            ['speciality_id' => 1, 'name' => 'Programación Estructurada', 'duration_hours' => 80],
            ['speciality_id' => 1, 'name' => 'Bases de Datos Relacionales', 'duration_hours' => 60],
            ['speciality_id' => 1, 'name' => 'Desarrollo Web Full Stack', 'duration_hours' => 120],
            ['speciality_id' => 1, 'name' => 'Inteligencia Artificial Básica', 'duration_hours' => 90],

            // Administración de Empresas (speciality_id = 2)
            ['speciality_id' => 2, 'name' => 'Gestión Empresarial', 'duration_hours' => 70],
            ['speciality_id' => 2, 'name' => 'Planificación Estratégica', 'duration_hours' => 60],
            ['speciality_id' => 2, 'name' => 'Finanzas Corporativas', 'duration_hours' => 80],

            // Contaduría Pública (speciality_id = 3)
            ['speciality_id' => 3, 'name' => 'Contabilidad General', 'duration_hours' => 90],
            ['speciality_id' => 3, 'name' => 'Auditoría Financiera', 'duration_hours' => 80],
            ['speciality_id' => 3, 'name' => 'Costos y Presupuestos', 'duration_hours' => 70],

            // Psicología (speciality_id = 4)
            ['speciality_id' => 4, 'name' => 'Psicología Organizacional', 'duration_hours' => 60],
            ['speciality_id' => 4, 'name' => 'Terapia Cognitivo-Conductual', 'duration_hours' => 80],

            // Diseño Gráfico (speciality_id = 5)
            ['speciality_id' => 5, 'name' => 'Diseño Digital', 'duration_hours' => 70],
            ['speciality_id' => 5, 'name' => 'Animación 2D', 'duration_hours' => 90],

            // Medicina (speciality_id = 6)
            ['speciality_id' => 6, 'name' => 'Anatomía Humana', 'duration_hours' => 100],
            ['speciality_id' => 6, 'name' => 'Farmacología Básica', 'duration_hours' => 80],

            // Arquitectura (speciality_id = 7)
            ['speciality_id' => 7, 'name' => 'Dibujo Arquitectónico', 'duration_hours' => 70],
            ['speciality_id' => 7, 'name' => 'Diseño Estructural', 'duration_hours' => 90],

            // Derecho (speciality_id = 8)
            ['speciality_id' => 8, 'name' => 'Derecho Civil', 'duration_hours' => 80],
            ['speciality_id' => 8, 'name' => 'Derecho Laboral', 'duration_hours' => 70],

            // Ingeniería Electrónica (speciality_id = 9)
            ['speciality_id' => 9, 'name' => 'Circuitos Electrónicos', 'duration_hours' => 90],
            ['speciality_id' => 9, 'name' => 'Microcontroladores', 'duration_hours' => 80],

            // Marketing Digital (speciality_id = 10)
            ['speciality_id' => 10, 'name' => 'SEO y SEM', 'duration_hours' => 60],
            ['speciality_id' => 10, 'name' => 'Redes Sociales para Empresas', 'duration_hours' => 50]
        ];

        foreach ($competencies as $competence) {
            Competencies::create([
                'speciality_id' => $competence['speciality_id'],
                'name' => $competence['name'],
                'duration_hours' => $competence['duration_hours']
            ]);
        }
    }
}
