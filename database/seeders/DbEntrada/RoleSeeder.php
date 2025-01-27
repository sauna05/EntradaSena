<?php

namespace Database\Seeders\DbEntrada;

    use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Para DB se importa illuminate support facades db

        DB::connection('db_entrada')->table('roles')->insert([
            ['role' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'Entrada', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'Coordinador', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'Aprendiz', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'Instructor Contratista', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'Instructor De Planta', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'Administrativo', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
