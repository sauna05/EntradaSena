<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Person;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    public function run(): void
    {
        $people = [
            [1, 1, '1111111111', 'Marlon Saenz', 'marlonsaenz@gmail.com', 'Calle 20#32-43', '300123123'],
            [3, 3, '3333333333', 'Carlos Perez', 'carlos.perez@example.com', 'Avenida 5#45-67', '3203334444'],
            [3, 2, '4444444444', 'Lucia Fernandez', 'lucia.fernandez@example.com', 'Calle 8#23-56', '3004445555'],
            [3, 1, '5555555555', 'Miguel Angel Ruiz', 'miguel.ruiz@example.com', 'Carrera 15#10-20', '3015556666'],
            [3, 5, '6666666666', 'Paula Andrea Soto', 'paula.soto@example.com', 'Calle 21#54-32', '3026667777'],
            [3, 3, '7777777777', 'Juan Camilo Vargas', 'juan.vargas@example.com', 'Avenida 7#11-22', '3037778888'],
            [4, 4, '8888888888', 'Sara Juliana Lopez', 'sara.lopez@example.com', 'Calle 16#30-40', '3048889999'],
            [4, 2, '9999999999', 'David Esteban Castro', 'david.castro@example.com', 'Carrera 25#15-60', '3059990000'],
            [4, 1, '1010101010', 'Westcol hp', 'draxen537@gmail.com', 'Calle 3#9-87', '3061010101'],
            [4, 5, '1212121212', 'Alexander Loperena', 'alexandersauna05@gmail.com', 'Avenida 12#34-56', '3071212121'],
        ];

        foreach ($people as $person) {
            Person::create([
                'id_position' => $person[0],
                'id_town' => $person[1],
                'document_number' => $person[2],
                'name' => $person[3],
                'email' => $person[4],
                'address' => $person[5],
                'phone_number' => $person[6],
                'start_date' => '2025-01-23',
                'end_date' => '2025-12-22',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
