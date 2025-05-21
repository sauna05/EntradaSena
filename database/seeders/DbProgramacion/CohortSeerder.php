<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Cohort;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CohortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cohorts = [
            [
                'number_cohort' => 10001,
                'id_program' => 1,
                'id_instructor' => 1,
                'id_time' => 1,
                'id_classroom' => 1,
                'id_town' => 1,
                'hours_school_stage' => 300,
                'hours_practical_stage' => 400,
                'start_date_school_stage' => '2025-01-01',
                'end_date_school_stage' => '2025-03-31',
                'start_date_practical_stage' => '2025-04-01',
                'end_date_practical_stage' => '2025-06-30',
            ],
            [
                'number_cohort' => 10002,
                'id_program' => 2,
                'id_instructor' => 2,
                'id_time' => 1,
                'id_classroom' => 2,
                'id_town' => 1,
                'hours_school_stage' => 320,
                'hours_practical_stage' => 380,
                'start_date_school_stage' => '2025-05-01',
                'end_date_school_stage' => '2025-07-31',
                'start_date_practical_stage' => '2025-08-01',
                'end_date_practical_stage' => '2025-10-31',
            ],
            [
                'number_cohort' => 10003,
                'id_program' => 3,
                'id_instructor' => 3,
                'id_time' => 2,
                'id_classroom' => 3,
                'id_town' => 2,
                'hours_school_stage' => 280,
                'hours_practical_stage' => 320,
                'start_date_school_stage' => '2025-09-01',
                'end_date_school_stage' => '2025-11-30',
                'start_date_practical_stage' => '2025-12-01',
                'end_date_practical_stage' => '2026-02-28',
            ],
            [
                'number_cohort' => 10004,
                'id_program' => 4,
                'id_instructor' => 4,
                'id_time' => 2,
                'id_classroom' => 1,
                'id_town' => 2,
                'hours_school_stage' => 310,
                'hours_practical_stage' => 410,
                'start_date_school_stage' => '2026-01-01',
                'end_date_school_stage' => '2026-03-31',
                'start_date_practical_stage' => '2026-04-01',
                'end_date_practical_stage' => '2026-06-30',
            ],
            [
                'number_cohort' => 10005,
                'id_program' => 5,
                'id_instructor' => 5,
                'id_time' => 1,
                'id_classroom' => 2,
                'id_town' => 3,
                'hours_school_stage' => 350,
                'hours_practical_stage' => 350,
                'start_date_school_stage' => '2026-07-01',
                'end_date_school_stage' => '2026-09-30',
                'start_date_practical_stage' => '2026-10-01',
                'end_date_practical_stage' => '2026-12-31',
            ],
            [
                'number_cohort' => 10006,
                'id_program' => 6,
                'id_instructor' => 1,
                'id_time' => 2,
                'id_classroom' => 3,
                'id_town' => 1,
                'hours_school_stage' => 300,
                'hours_practical_stage' => 300,
                'start_date_school_stage' => '2027-01-01',
                'end_date_school_stage' => '2027-03-31',
                'start_date_practical_stage' => '2027-04-01',
                'end_date_practical_stage' => '2027-06-30',
            ],
            [
                'number_cohort' => 10007,
                'id_program' => 7,
                'id_instructor' => 2,
                'id_time' => 1,
                'id_classroom' => 1,
                'id_town' => 1,
                'hours_school_stage' => 270,
                'hours_practical_stage' => 330,
                'start_date_school_stage' => '2027-05-01',
                'end_date_school_stage' => '2027-07-31',
                'start_date_practical_stage' => '2027-08-01',
                'end_date_practical_stage' => '2027-10-31',
            ],
            [
                'number_cohort' => 10008,
                'id_program' => 8,
                'id_instructor' => 3,
                'id_time' => 2,
                'id_classroom' => 2,
                'id_town' => 2,
                'hours_school_stage' => 400,
                'hours_practical_stage' => 500,
                'start_date_school_stage' => '2027-09-01',
                'end_date_school_stage' => '2027-11-30',
                'start_date_practical_stage' => '2027-12-01',
                'end_date_practical_stage' => '2028-02-28',
            ],
            [
                'number_cohort' => 10009,
                'id_program' => 9,
                'id_instructor' => 4,
                'id_time' => 1,
                'id_classroom' => 3,
                'id_town' => 3,
                'hours_school_stage' => 250,
                'hours_practical_stage' => 300,
                'start_date_school_stage' => '2028-01-01',
                'end_date_school_stage' => '2028-03-31',
                'start_date_practical_stage' => '2028-04-01',
                'end_date_practical_stage' => '2028-06-30',
            ],
            [
                'number_cohort' => 10010,
                'id_program' => 10,
                'id_instructor' => 5,
                'id_time' => 2,
                'id_classroom' => 1,
                'id_town' => 1,
                'hours_school_stage' => 330,
                'hours_practical_stage' => 330,
                'start_date_school_stage' => '2028-07-01',
                'end_date_school_stage' => '2028-09-30',
                'start_date_practical_stage' => '2028-10-01',
                'end_date_practical_stage' => '2028-12-31',
            ],
        ];

        foreach ($cohorts as $cohort) {
            Cohort::create($cohort);
        }
    }
}
