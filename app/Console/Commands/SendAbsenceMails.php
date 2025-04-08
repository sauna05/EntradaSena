<?php

namespace App\Console\Commands;

use App\Models\DbEntrada\NotificationAbsence;
use App\Models\DbEntrada\Person;
use App\Notifications\AbsenceNotification;
use Illuminate\Console\Command;

class SendAbsenceMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-absence-mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía Correo electronico de inasistencias)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $absences = NotificationAbsence::where('state', 'pendiente')
            ->where('answered', false)
            ->get();

        foreach ($absences as $absence) {
            $person = Person::find($absence->id_person);

            if ($person) {
                $person->notify(new AbsenceNotification($person));

                $absence->update([
                    'readed' => true
                ]);
            }
        }

        $this->info("Correos enviados correctamente.");    }
}
