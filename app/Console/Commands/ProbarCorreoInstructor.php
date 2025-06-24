<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\ProgramacionCompetenciaMail;
use App\Models\DbProgramacion\Programming as DbProgramacionProgramming;
use Illuminate\Support\Facades\Mail;

class ProbarCorreoInstructor extends Command
{
    protected $signature = 'correo:probar-instructor {programming_id}';
    protected $description = 'Envía un correo de prueba al instructor de una programación';

    public function handle()
    {
        $programming = DbProgramacionProgramming::with([
            'instructor.person', // Carga la relación instructor y su person
            'competencie',
            'cohort',
            'classroom',
            'days'
        ])->find($this->argument('programming_id'));

        if (!$programming) {
            $this->error('No se encontró la programación.');
            return;
        }

        if (!$programming->instructor || !$programming->instructor->person || !$programming->instructor->person->email) {
            $this->error('El instructor o su email no están disponibles.');
            return;
        }

        $email = $programming->instructor->person->email;

        Mail::to($email)->send(new ProgramacionCompetenciaMail($programming));

        $this->info('Correo enviado a ' . $email);
    }
}
