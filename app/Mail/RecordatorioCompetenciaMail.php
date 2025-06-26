<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecordatorioCompetenciaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $programming;

    /**
     * Create a new message instance.
     */
    public function __construct($programming)
    {
        $this->programming = $programming;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = 'Recordatorio: Competencia próxima a finalizar';

        // Formatea las fechas en español
        \Carbon\Carbon::setLocale('es');
        $fechaFin = \Carbon\Carbon::parse($this->programming->end_date)->translatedFormat('j \d\e F \d\e\l Y');

        $body = "
            <p>Hola, {$this->programming->instructor->person->name}:</p>
            <p>Este es un recordatorio de que la competencia <strong>{$this->programming->competencie->name}</strong> finalizará el <strong>{$fechaFin}</strong>.</p>
            <p>Por favor, asegúrese de tener todo listo para la finalización de la competencia.</p>
            <ul>
                <li><strong>Programa:</strong> {$this->programming->cohort->program->name}</li>
                <li><strong>Ficha:</strong> {$this->programming->cohort->number_cohort}</li>
                <li><strong>Ambiente:</strong> {$this->programming->classroom->name}</li>
            </ul>
            <p>Si tiene alguna duda, comuníquese con la coordinación académica.</p>
            <p>Cordialmente,<br>
            Coordinación Académica</p>
        ";

        return $this->subject($subject)
            ->html($body);
    }
}
