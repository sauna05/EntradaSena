<?php

namespace Database\Seeders\DbEntrada;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('db_entrada')->table('users')->insert([

            ['id_person'=> 1, 'user_name' => 'MarlonSaenz', 'password' => bcrypt("123123"), 'created_at' => now(), 'updated_at' => now() ],

        ]);
    }
}
