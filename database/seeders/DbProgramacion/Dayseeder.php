<?php

namespace Database\Seeders\DbProgramacion;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DbProgramacion\Day; // Ajusta el namespace si es necesario

class Dayseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diasDeLaSemana = [
            'Lunes',
            'Martes',
            'Miércoles',
            'Jueves',
            'Viernes',
            'Sábado',
            'Domingo',
        ];

        foreach ($diasDeLaSemana as $dia) {
            Day::create(['name' => $dia]);
        }
    }
}
