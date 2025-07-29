<?php

namespace Database\Seeders\DbProgramacion;

use Illuminate\Database\Seeder;
use App\Models\DbProgramacion\People_days_available;
use App\Models\DbProgramacion\EntranceExit;
use Illuminate\Support\Carbon;

class PersonSeederExit extends Seeder
{
    public function run(): void
    {
        $personas = [
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
            ['id' => 4],
            ['id' => 5],
            ['id' => 6],
            ['id' => 7],
            ['id' => 8],
            ['id' => 9],
        ];

        foreach ($personas as $persona) {
            // Todos los días disponibles
            foreach (range(1, 7) as $day) {
                People_days_available::create([
                    'id_person' => $persona['id'],
                    'id_day_available' => $day,
                ]);
            }

            // Generar asistencias entre enero y julio
            $asistencias = $this->generateAsistenciasParaMeses(2025, 1, 7);

            foreach ($asistencias as $asistencia) {
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

    private function generateAsistenciasParaMeses(int $año, int $mesInicio, int $mesFin): array
    {
        $asistencias = [];

        for ($mes = $mesInicio; $mes <= $mesFin; $mes++) {
            $cantidad = rand(20, 40); // entre 10 y 30 asistencias por mes

            for ($i = 0; $i < $cantidad; $i++) {
                $dia = rand(1, 31); // para evitar problemas con días inexistentes
                $fecha = Carbon::create($año, $mes, $dia)->format('Y-m-d');

                $horaEntrada = Carbon::createFromTime(rand(5, 9), rand(0, 59), 0);
                $horaSalida = (clone $horaEntrada)->addHours(rand(3, 5))->addMinutes(rand(0, 59));

                $asistencias[] = [
                    'date' => $fecha,
                    'entrada' => $horaEntrada->format('H:i:s'),
                    'salida' => $horaSalida->format('H:i:s'),
                ];
            }
        }

        return $asistencias;
    }
}
