<?php

namespace Database\Seeders;

use App\Models\DbProgramacion\Instructor;
use App\Models\DbProgramacion\Speciality;
use App\Models\User;
use Database\Seeders\db_programacion\Dayseeder;
use Database\Seeders\DbProgramacion\AprenticesSeeder;
use Database\Seeders\DbProgramacion\CohortTimeSeeder;
use Database\Seeders\DbProgramacion\PersonSeeder as Db_programacionPersonSeeder;
use Database\Seeders\DbProgramacion\PositionSeeder as Db_programacionPositionSeeder;
use Database\Seeders\DbProgramacion\TownSeeder;
use Database\Seeders\DbProgramacion\DayAvailable;
use Database\Seeders\DbProgramacion\PersonSeeder;
use Database\Seeders\DbProgramacion\PersonSeederExit;
use Database\Seeders\DbProgramacion\RoleSeeder;
use Database\Seeders\DbProgramacion\UserSeeder;
use Database\Seeders\DbProgramacion\ApprenticeStatusSeeder;
use Database\Seeders\DbProgramacion\BlokSeeder;
use Database\Seeders\DbProgramacion\ClassRoomSeeder;

use Database\Seeders\DbProgramacion\InstructorSeeder;
use Database\Seeders\DbProgramacion\InstructorStatusSeeder;
use Database\Seeders\DbProgramacion\LinkTypeSeeder;
use Database\Seeders\DbProgramacion\ProgramanLevelSeeder;
use Database\Seeders\DbProgramacion\ProgramSeeder;
use Database\Seeders\DbProgramacion\SpecialitySeeder;

use Database\Seeders\DbProgramacion\CohortSeeder;
use Database\Seeders\DbProgramacion\CompetenceSeeder;
use Database\Seeders\DbProgramacion\Dayseeder as DbProgramacionDayseeder;
use Database\Seeders\DbProgramacion\DaysTrainingSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // //Seeders para la base de datos de la entrada
        // Config::set('database.default', 'db_entrada');
        // DB::connection('db_entrada')->beginTransaction();

        // $this->call([
        //     PositionSeeder::class,
        //     // RoleSeeder::class,
        //     // PersonSeeder::class,
        //     // UserSeeder::class,
        //     // DayAvailable::class,
        //     // PersonSeederExit::class
        // ]);
        // DB::connection('db_entrada')->commit();

        //Seeders para la base de datos de programación
        Config::set('database.default', 'db_programacion');
        DB::connection('db_programacion')->beginTransaction();

        $this->call([
            Db_programacionPositionSeeder::class,
            RoleSeeder::class,
            TownSeeder::class,
            PersonSeeder::class,
            UserSeeder::class,
            DayAvailable::class,
            PersonSeederExit::class,

            CohortTimeSeeder::class,
            LinkTypeSeeder::class,
            SpecialitySeeder::class,
            InstructorStatusSeeder::class,
            ApprenticeStatusSeeder::class,
            ProgramanLevelSeeder::class,
            InstructorSeeder::class,
            ProgramSeeder::class,
            AprenticesSeeder::class,
            BlokSeeder::class,
            ClassRoomSeeder::class,
            CohortSeeder::class,
            DbProgramacionDayseeder::class,
            CompetenceSeeder::class,
            DaysTrainingSeeder::class,
        ]);
        DB::connection('db_programacion')->commit();
    }
}
