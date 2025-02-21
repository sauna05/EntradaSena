<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Db_programacion\PersonSeeder as Db_programacionPersonSeeder;
use Database\Seeders\Db_programacion\PositionSeeder as Db_programacionPositionSeeder;
use Database\Seeders\Db_programacion\TownSeeder;
use Database\Seeders\DbEntrada\DayAvailable;
use Database\Seeders\DbEntrada\PersonSeeder;
use Database\Seeders\DbEntrada\PositionSeeder;
use Database\Seeders\DbEntrada\RoleSeeder;
use Database\Seeders\DbEntrada\UserSeeder;
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

      //Seeders para la base de datos de la entrada
        Config::set('database.default', 'db_entrada');
        DB::connection('db_entrada')->beginTransaction();
        
        $this->call([
        PositionSeeder::class,
        RoleSeeder::class,
        PersonSeeder::class,
        UserSeeder::class,
        DayAvailable::class
      ]); 
      DB::connection('db_entrada')->commit();

      //Seeders para la base de datos de programación
      Config::set('database.default','db_programacion');
      DB::connection('db_programacion')->beginTransaction();

      $this->call([
       Db_programacionPositionSeeder::class,
       TownSeeder::class,
       Db_programacionPersonSeeder::class
      ]);
      DB::connection('db_programacion')->commit();

      
    }
}
