<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\CohorTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CohortTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CohorTime::create([

            "name"=>"Diurna"
        ]);

        //
        CohorTime::create([

            "name" => "Nocturna"
        ]);
    }
}
