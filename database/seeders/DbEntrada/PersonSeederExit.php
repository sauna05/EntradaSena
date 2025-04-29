<?php

namespace Database\Seeders\DbEntrada;

use Illuminate\Database\Seeder;
use App\Models\DbEntrada\People_days_available;
use App\Models\DbEntrada\EntranceExit;

class PersonSeederExit extends Seeder
{
    public function run(): void
    {
        $personas = [
            [
                'id' => 1,
                'days' => [1, 2, 3, 4, 5, 6, 7],
                'asistencias' => [
                    ['date' => '2025-04-19', 'entrada' => '05:19:38', 'salida' => '07:19:38'],
                    ['date' => '2025-04-29', 'entrada' => '06:30:00', 'salida' => '12:00:00'],
                ],
            ],
            [
                'id' => 2,
                'days' => [1, 2, 3, 4, 5, 6, 7],
                'asistencias' => [
                    ['date' => '2025-04-23', 'entrada' => '08:00:00', 'salida' => '12:00:00'],
                    ['date' => '2025-03-29i', 'entrada' => '07:00:00', 'salida' => '11:30:00'],
                ],
            ],
            [
                'id' => 3,
                'days' => [1, 2, 3, 4, 5, 6, 7],
                'asistencias' => [
                    ['date' => '2025-04-23', 'entrada' => '09:00:00', 'salida' => '13:00:00'],
                    ['date' => '2025-04-29', 'entrada' => '10:00:00', 'salida' => '14:00:00'],
                ],
            ],
            [
                'id' => 4,
                'days' => [1, 2, 3, 4, 5, 6, 7],
                'asistencias' => [
                    ['date' => '2025-03-20', 'entrada' => '06:45:00', 'salida' => '11:45:00'],
                    ['date' => '2025-04-01', 'entrada' => '07:00:00', 'salida' => '12:00:00'],
                ],
            ],
            [
                'id' => 5,
                'days' => [1, 2, 3, 4, 5, 6, 7],
                'asistencias' => [
                    ['date' => '2025-04-23', 'entrada' => '08:30:00', 'salida' => '13:00:00'],
                    ['date' => '2025-04-29', 'entrada' => '07:15:00', 'salida' => '11:45:00'],
                ],
            ],
            [
                'id' => 6,
                'days' => [1, 2, 3, 4, 5, 6, 7],
                'asistencias' => [
                    ['date' => '2025-04-23', 'entrada' => '05:50:00', 'salida' => '10:30:00'],
                    ['date' => '2025-04-29', 'entrada' => '06:00:00', 'salida' => '10:00:00'],
                ],
            ],

            [
                'id' => 7,
                'days' => [1, 2, 3, 4, 5, 6, 7],
                'asistencias' => [
                    ['date' => '2025-04-24', 'entrada' => '05:50:00', 'salida' => '10:30:00'],
                    ['date' => '2025-04-22', 'entrada' => '06:00:00', 'salida' => '10:00:00'],
                ],
            ],

            [
                'id' => 8,
                'days' => [1, 2, 3, 4, 5, 6, 7],
                'asistencias' => [
                    ['date' => '2025-04-24', 'entrada' => '05:50:00', 'salida' => '10:30:00'],
                    ['date' => '2025-04-19', 'entrada' => '06:00:00', 'salida' => '10:00:00'],
                ],
            ],
            [
                'id' => 9,
                'days' => [1, 2, 3, 4, 5, 6, 7],
                'asistencias' => [
                    ['date' => '2025-04-24', 'entrada' => '05:50:00', 'salida' => '10:30:00'],
                    ['date' => '2025-04-03', 'entrada' => '06:00:00', 'salida' => '10:00:00'],
                    ['date' => '2025-04-20', 'entrada' => '05:50:00', 'salida' => '10:30:00'],
                    ['date' => '2025-04-19', 'entrada' => '06:00:00', 'salida' => '10:00:00'],
                    ['date' => '2025-04-18', 'entrada' => '05:50:00', 'salida' => '10:30:00'],
                    ['date' => '2025-04-17', 'entrada' => '06:00:00', 'salida' => '10:00:00'],
                    ['date' => '2025-04-16', 'entrada' => '05:50:00', 'salida' => '10:30:00'],
                    ['date' => '2025-04-15', 'entrada' => '06:00:00', 'salida' => '10:00:00'],
                ],
            ],
        ];

        foreach ($personas as $persona) {
            foreach ($persona['days'] as $day) {
                People_days_available::create([
                    'id_person' => $persona['id'],
                    'id_day_available' => $day,
                ]);
            }

            foreach ($persona['asistencias'] as $asistencia) {
                EntranceExit::create([
                    'id_person' => $persona['id'],
                    'date_time' => $asistencia['date'] . ' ' . $asistencia['entrada'],
                    'action' => 'entrada',
                ]);

                EntranceExit::create([
                    'id_person' => $persona['id'],
                    'date_time' => $asistencia['date'] . ' ' . $asistencia['salida'],
                    'action' => 'salida',
                ]);
            }
        }
    }
}
