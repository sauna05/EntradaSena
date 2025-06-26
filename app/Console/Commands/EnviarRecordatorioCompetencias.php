<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DbProgramacion\Programming;
use App\Mail\RecordatorioCompetenciaMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class EnviarRecordatorioCompetencias extends Command
{
    protected $signature = 'competencias:recordatorio';
    protected $description = 'Envía recordatorios 5 días antes de la finalización de competencias';

    public function handle()
    {
        $fechaObjetivo = Carbon::now()->addDays(5)->toDateString();

        $programaciones = Programming::with(['instructor.person', 'competencie'])
            ->whereDate('end_date', $fechaObjetivo)
            ->get();

        foreach ($programaciones as $programming) {
            $email = $programming->instructor->person->email ?? null;

            if ($email) {
                Mail::to($email)->send(new RecordatorioCompetenciaMail($programming));
                $this->info("Recordatorio enviado a {$email} para competencia {$programming->competencie->name}");
            }
        }

        $this->info('Proceso de recordatorios finalizado.');
    }
}
