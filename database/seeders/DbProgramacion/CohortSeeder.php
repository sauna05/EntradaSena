<?php

namespace Database\Seeders\DbProgramacion;

use Illuminate\Database\Seeder;
use App\Models\DbProgramacion\Cohort;
use Carbon\Carbon;

class CohortSeeder extends Seeder
{
    public function run(): void
    {
        // Creamos 10 fichas (cohortes)
        for ($i = 0; $i < 10; $i++) {
            $startSchool = Carbon::create(2025, rand(1, 6), rand(1, 28));
            $endSchool = (clone $startSchool)->addMonths(6);

            $startPractice = (clone $endSchool)->addDays(1);
            $endPractice = (clone $startPractice)->addMonths(6);

            Cohort::create([
                'number_cohort' => 206 . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'id_program' => rand(1, 10),      // Asegúrate de que existan programas con estos IDs
                'id_time' => rand(1, 2),         // Jornada o turno
                'id_town' => rand(1, 5),         // Asegúrate de tener municipios cargados

                'hours_school_stage' => 880,
                'hours_practical_stage' => 920,

                'start_date_school_stage' => $startSchool,
                'end_date_school_stage' => $endSchool,

                'start_date_practical_stage' => $startPractice,
                'end_date_practical_stage' => $endPractice,
            ]);
        }
    }
}
