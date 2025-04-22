<?php

namespace Database\Seeders\DbEntrada;

use App\Models\DbEntrada\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::connection('db_entrada')->table('people')->insert([
        //     ['id_role'=> 3, 'document_number' => '1111111111', 'name' =>'Marlon Saenz', 'start_date'=> '2024-12-4', 'end_date' => '2030-04-22', 'created_at' => now(), 'updated_at' => now()],
        //     ['id_role'=> 4, 'document_number' => '123456789', 'name' =>'Aprendiz de Prueba', 'start_date'=> '2023-01-23', 'end_date' => '2025-04-22', 'created_at' => now(), 'updated_at' => now()],
        //     ['id_role'=> 4, 'document_number' => '987654321', 'name' =>'Segundo Aprendiz de Prueba', 'start_date'=> '2023-06-21', 'end_date' => '2025-10-22', 'created_at' => now(), 'updated_at' => now()],

        // ]);

        Person::create([
            'id_position'=> 1,
            'document_number' => '1111111111',
            'name' =>'Marlon Saenz',
            'start_date'=> '2024-12-4',
            'end_date' => '2030-12-24',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Person::create([
            'id_position' => 3,
            'document_number' => '123456789',
            'name' => 'Robin Daniel Jimenez Florez',
            'start_date' => '2023-1-23',
            'end_date' => '2025-04-22',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Person::create([
            'id_position' => 3,
            'document_number' => '1005188631',
            'name' => 'Wendy Yulieth Perez Navarro',
            'start_date' => '2023-1-23',
            'end_date' => '2025-04-22',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        Person::create([
            'id_position' => 3,
            'document_number' => '1043434038',
            'name' => 'Leidi Esther Lizcano Arroyo',
            'start_date' => '2023-1-23',
            'end_date' => '2025-04-22',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Person::create([
            'id_position' => 3,
            'document_number' => '321321321',
            'name' => 'JoseGay Andres Ronaldo',
            'start_date' => '2023-1-23',
            'end_date' => '2025-04-22',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Person::create([
            'id_position' => 3,
            'document_number' => '1122399124',
            'name' => 'alexander Loperena Sauna',
            'start_date' => '2023-1-23',
            'end_date' => '2025-04-22',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
