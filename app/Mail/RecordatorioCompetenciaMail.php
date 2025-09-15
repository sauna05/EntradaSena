<?php

namespace App\Mail;

use Carbon\Carbon;
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
        // Formatea las fechas en español
        Carbon::setLocale('es');
        $fecha_de_terminacion = Carbon::parse($this->programming->end_date)->translatedFormat('j \d\e F \d\e\l Y');

        // Obtener los datos necesarios
        $instructor = $this->programming->instructor->person->name;
        $compe = $this->programming->competencie->name;
        $curso = $this->programming->cohort->program->name;
        $ficha = $this->programming->cohort->number_cohort;

        // Construir el cuerpo del mensaje según lo solicitado
        $cuerpo = "<p>Señor <strong>" . $instructor . "</strong>, la coordinacion academica del Centro Agroempresarial y Acuícola le informa que el dia: <strong>" . $fecha_de_terminacion . "</strong> se termina la competencia";
        $cuerpo .= " <strong>" . $compe . "</strong>, que le fue programada a usted en el curso <strong>" . $curso . "</strong>, con ficha <strong>" . $ficha . "</strong>.</p>";
        $cuerpo .= "<p>Recuerde que una vez termine la competencia tiene tres días máximos para evaluarla.</p>";
        $cuerpo .= "<br><br>";
        $cuerpo .= "<p>Cordialmente:</p>";
        $cuerpo .= "<br>";
        $cuerpo .= "<p><strong>Marlon Sanchez</strong><br>";
        $cuerpo .= "Coordinador Academico</p>";

        $asunto = "Terminacion de competencia";

        return $this->subject($asunto)
            ->html($cuerpo);
    }
}
