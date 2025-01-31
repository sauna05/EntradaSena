<?php

namespace Database\Seeders\DbEntrada;

use App\Models\DbEntrada\User;
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
        // DB::connection('db_entrada')->table('users')->insert([

        //     // ['id_person'=> 1, 'user_name' => 'MarlonSaenz', 'password' => bcrypt("123123"), 'created_at' => now(), 'updated_at' => now() ],

        // ]);

        User::create([
            'id_person'=> 1, 'user_name' => 'MarlonSaenz', 'password' => bcrypt("123123")
        ])->assignRole('Administrador');

        User::create([
            'id_person' => 2,
            'user_name' => '123123123',
            'password' => bcrypt("123123123")
        ])->assignRole('Aprendiz');
        
    }
}
