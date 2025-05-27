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
            // Cocina
            ['name' => 'Fundamentos de Cocina Básica', 'duration_hours' => 60],
            ['name' => 'Pastelería y Repostería', 'duration_hours' => 80],
            ['name' => 'Cocina Internacional', 'duration_hours' => 100],
            ['name' => 'Técnicas de Cocina Fría', 'duration_hours' => 40],
            ['name' => 'Gestión de Alimentos y Bebidas', 'duration_hours' => 50],

            // Informática
            ['name' => 'Programación Básica', 'duration_hours' => 80],
            ['name' => 'Desarrollo Web Frontend', 'duration_hours' => 120],
            ['name' => 'Bases de Datos SQL', 'duration_hours' => 60],
            ['name' => 'Ciberseguridad Fundamental', 'duration_hours' => 90],
            ['name' => 'Redes de Computadoras', 'duration_hours' => 70],

            // Gestión Empresarial
            ['name' => 'Administración de Empresas', 'duration_hours' => 60],
            ['name' => 'Contabilidad Básica', 'duration_hours' => 50],
            ['name' => 'Marketing Digital', 'duration_hours' => 80],
            ['name' => 'Gestión de Proyectos', 'duration_hours' => 70],
            ['name' => 'Atención al Cliente', 'duration_hours' => 30],

            // Otras áreas
            ['name' => 'Inglés para Negocios', 'duration_hours' => 100],
            ['name' => 'Diseño Gráfico Básico', 'duration_hours' => 60],
            ['name' => 'Mantenimiento de Equipos de Cómputo', 'duration_hours' => 50],
            ['name' => 'Soldadura Básica', 'duration_hours' => 80],
            ['name' => 'Primeros Auxilios', 'duration_hours' => 20]
        ];

        foreach ($competencies as $competence) {
            Competencies::create([
                'name' => $competence['name'],
                'duration_hours' => $competence['duration_hours']
            ]);
        }
    }
}
