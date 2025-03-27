<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Person::create([
            'id_position' => 1,
            'id_town' => 1,
            'document_number' => '1111111111',
            'name' => 'Marlon Saenz',
            'email' => 'Marlonsaenz@gmail.com',
            'address' => 'Calle 20#32-43',
            'phone_number' => '300123123',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        
        Person::create([
            'id_position' => 3,
            'id_town' => 1,
            'document_number' => '123456789',
            'name' => 'Robin Daniel Jimenez Florez',
            'email' => 'robindannjf@gmail.com',
            'address' => 'Calle 19#17-06',
            'phone_number' => '3006045694',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Person::create([
            'id_position' => 3,
            'id_town' => 4,
            'document_number' => '1043434038',
            'name' => 'Leidi Esther Lizcano Arroyo',
            'email' => 'lizcanoleidi@gmail.com',
            'address' => 'Calle 432-433',
            'phone_number' => '300123123',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Person::create([
            'id_position' => 3,
            'id_town' => 4,
            'document_number' => '321321321',
            'name' => 'JoseGay Andres Ronaldo',
            'email' => 'joseandressolano2003@gmail.com',
            'address' => 'Calle lgtv-433',
            'phone_number' => '300123123',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
    }
}
