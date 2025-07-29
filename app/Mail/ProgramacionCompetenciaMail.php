<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class ProgramacionCompetenciaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $programming;

    public function __construct($programming)
    {
        $this->programming = $programming;
    }

    public function build()
    {
        $subject = 'Nueva programación de competencia';

        // Configuramos Carbon para usar español
        Carbon::setLocale('es');

        // Formateamos las fechas
        $fechaInicio = Carbon::parse($this->programming->start_date)->translatedFormat('j \d\e F \d\e\l Y');
        $fechaFin = Carbon::parse($this->programming->end_date)->translatedFormat('j \d\e F \d\e\l Y');

        // Construimos el cuerpo del correo con el mensaje solicitado
        $body = "
            <p>Hola, {$this->programming->instructor->person->name}</p>

            <p>Se le ha programado la competencia <strong>{$this->programming->competencie->name}</strong> desde <strong>{$fechaInicio}</strong> hasta <strong>{$fechaFin}</strong></p>
            <p>en el programa <strong>{$this->programming->cohort->program->name}</strong> con la ficha <strong>{$this->programming->cohort->number_cohort}</strong>.</p>

            <p><strong>Ambiente:</strong> {$this->programming->classroom->name}</p>

            <p><strong>Horario:</strong></p>
            <ul>";

        // Listamos los días con horario
        foreach ($this->programming->days as $day) {
            $body .= "<li>{$day->name}: {$this->programming->start_time} a {$this->programming->end_time}</li>";
        }

        $body .= "</ul>
            <p>Por favor verifique que la información sea correcta, de lo contrario acérquese a la coordinación académica.</p>

            <p>Cordialmente,<br>
          <strong> Marlon Sanchenz </strong> <br>
            Coordinación Académica</p>
        ";

        return $this->subject($subject)
            ->html($body);
    }
}
