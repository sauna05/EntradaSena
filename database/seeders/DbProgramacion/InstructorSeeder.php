<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Instructor;
use App\Models\DbProgramacion\Person;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener todas las personas que tengan el rol de instructor (id_position = 4)
        $instructores = Person::where('id_position', 4)->get();

        foreach ($instructores as $person) {
            Instructor::create([
                "id_person" => $person->id,
                "id_status" => 1, // Activo
                "id_link_type" => rand(1, 2), // 1=Contrato, 2=Planta
                "id_speciality" => rand(1, 86), // Especialidades aleatorias entre 1 y 86
                "assigned_hours" => rand(800, 1600),
                "hours_day" => rand(4, 8),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
