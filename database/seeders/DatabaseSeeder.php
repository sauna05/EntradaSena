<?php

namespace Database\Seeders;

use App\Models\User;
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
        UserSeeder::class
      ]); 
      DB::connection('db_entrada')->commit();

      //Seeders para la base de datos de programación
      Config::set('database.default','db_programacion');
      DB::connection('db_programacion')->beginTransaction();

      $this->call([

      ]);
      DB::connection('db_programacion')->commit();

      
    }
}
