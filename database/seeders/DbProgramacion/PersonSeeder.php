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
        //rol Cordinador
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

        //estos seran con rol Aprendiz

        Person::create([
            'id_position' => 3,
            'id_town' => 3,
            'document_number' => '3333333333',
            'name' => 'Carlos Perez',
            'email' => 'carlos.perez@example.com',
            'address' => 'Avenida 5#45-67',
            'phone_number' => '3203334444',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Person::create([
            'id_position' => 3,
            'id_town' => 2,
            'document_number' => '4444444444',
            'name' => 'Lucia Fernandez',
            'email' => 'lucia.fernandez@example.com',
            'address' => 'Calle 8#23-56',
            'phone_number' => '3004445555',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Person::create([
            'id_position' => 3,
            'id_town' => 1,
            'document_number' => '5555555555',
            'name' => 'Miguel Angel Ruiz',
            'email' => 'miguel.ruiz@example.com',
            'address' => 'Carrera 15#10-20',
            'phone_number' => '3015556666',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Person::create([
            'id_position' => 3,
            'id_town' => 5,
            'document_number' => '6666666666',
            'name' => 'Paula Andrea Soto',
            'email' => 'paula.soto@example.com',
            'address' => 'Calle 21#54-32',
            'phone_number' => '3026667777',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Person::create([
            'id_position' => 3,
            'id_town' => 3,
            'document_number' => '7777777777',
            'name' => 'Juan Camilo Vargas',
            'email' => 'juan.vargas@example.com',
            'address' => 'Avenida 7#11-22',
            'phone_number' => '3037778888',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //estos seran con rol instructor
        Person::create([
            'id_position' => 4,
            'id_town' => 4,
            'document_number' => '8888888888',
            'name' => 'Sara Juliana Lopez',
            'email' => 'sara.lopez@example.com',
            'address' => 'Calle 16#30-40',
            'phone_number' => '3048889999',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Person::create([
            'id_position' => 4,
            'id_town' => 2,
            'document_number' => '9999999999',
            'name' => 'David Esteban Castro',
            'email' => 'david.castro@example.com',
            'address' => 'Carrera 25#15-60',
            'phone_number' => '3059990000',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Person::create([
            'id_position' => 4,
            'id_town' => 1,
            'document_number' => '1010101010',
            'name' => 'Valentina Rios',
            'email' => 'valentina.rios@example.com',
            'address' => 'Calle 3#9-87',
            'phone_number' => '3061010101',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Person::create([
            'id_position' => 4,
            'id_town' => 5,
            'document_number' => '1212121212',
            'name' => 'Sebastian Gomez',
            'email' => 'sebastian.gomez@example.com',
            'address' => 'Avenida 12#34-56',
            'phone_number' => '3071212121',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
    }
}
