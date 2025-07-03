<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Instructor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Instructor::create([
            "id_person"=>7,
            "id_status"=>1,
            "id_link_type"=>2,
            "id_speciality"=>1,
            "assigned_hours"=>850,
            "months_contract"=>12,
            "hours_day"=>4,
            'created_at' => now(),
            'updated_at' => now()

        ]);

        Instructor::create([
            "id_person" => 8,
            "id_status" => 1,
            "id_link_type" => 2,
            "id_speciality" => 9,
            "assigned_hours" => 950,
            "months_contract" => 10,
            "hours_day" => 4,
            'created_at' => now(),
            'updated_at' => now()

        ]);


        Instructor::create([
            "id_person" => 9,
            "id_status" => 1,
            "id_link_type" => 2,
            "id_speciality" => 1,
            "assigned_hours" => 1200,
            "months_contract" => 11,
            "hours_day" => 4,
            'created_at' => now(),
            'updated_at' => now()

        ]);
        Instructor::create([
            "id_person" => 10,
            "id_status" => 1,
            "id_link_type" => 1,
            "id_speciality" => 7,
            "assigned_hours" => 900,
            "months_contract" => 12,
            "hours_day" => 6,
            'created_at' => now(),
            'updated_at' => now()

        ]);


    }
}
