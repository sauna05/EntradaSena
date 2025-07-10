<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Instructor;
use App\Models\DbProgramacion\Person;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener 20 personas que tengan el rol de instructor (id_position = 4)
        $instructores = Person::where('id_position', 4)->take(20)->get();

        foreach ($instructores as $person) {
            Instructor::create([
                "id_person" => $person->id,
                "id_status" => 1,
                "id_link_type" => rand(1, 2),
                "id_speciality" => rand(1, 10), // Asegúrate de tener especialidades con estos IDs
                "assigned_hours" => rand(800, 1200),
                "months_contract" => rand(6, 12),
                "hours_day" => rand(4, 8),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
