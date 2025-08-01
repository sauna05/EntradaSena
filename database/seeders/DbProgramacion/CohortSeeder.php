<?php

namespace Database\Seeders\DbProgramacion;

use Illuminate\Database\Seeder;
use App\Models\DbProgramacion\Cohort;
use App\Models\DbProgramacion\Town;
use Carbon\Carbon;

class CohortSeeder extends Seeder
{
    public function run(): void
    {
        $cantidad_matriculados_por_defecto = 23;

        // Obtener ID del municipio "Fonseca"
        $id_fonseca = Town::where('name', 'Fonseca')->value('id');

        // Obtener IDs de otros municipios diferentes a Fonseca
        $otros_municipios = Town::where('name', '!=', 'Fonseca')->pluck('id')->toArray();

        // 1. Crear 20 cohortes con Fonseca
        for ($i = 1; $i <= 20; $i++) {
            $this->crearCohorte($i, $id_fonseca, $cantidad_matriculados_por_defecto);
        }

        // 2. Crear 10 cohortes con otros municipios
        for ($i = 21; $i <= 30; $i++) {
            $id_random = $otros_municipios[array_rand($otros_municipios)];
            $this->crearCohorte($i, $id_random, $cantidad_matriculados_por_defecto);
        }
    }

    private function crearCohorte($index, $id_town, $enrolled_quantity)
    {
        $startSchool = Carbon::create(2025, rand(1, 6), rand(1, 28));
        $endSchool = (clone $startSchool)->addMonths(6);

        $startPractice = (clone $endSchool)->addDays(1);
        $endPractice = (clone $startPractice)->addMonths(6);

        Cohort::create([
            'number_cohort' => 206 . str_pad($index, 4, '0', STR_PAD_LEFT),
            'id_program' => rand(1, 10),
            'id_time' => rand(1, 2),
            'id_town' => $id_town,
            'hours_school_stage' => 880,
            'hours_practical_stage' => 920,
            'start_date_school_stage' => $startSchool,
            'end_date_school_stage' => $endSchool,
            'start_date_practical_stage' => $startPractice,
            'end_date_practical_stage' => $endPractice,
            'enrolled_quantity' => $enrolled_quantity,
        ]);
    }
}
