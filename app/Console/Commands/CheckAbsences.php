<?php

namespace App\Console\Commands;

use App\Models\DbEntrada\EntranceExit;
use App\Models\DbEntrada\NotificationAbsence;
use App\Models\DbEntrada\Person;
use App\Models\DbProgramacion\Person as DbProgramacionPerson;
use App\Notifications\AbsenceNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckAbsences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-absences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica Inasistencias y Envía Correo electronico (Se generan en el apartado de Inasistencias de la entrada)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();
        $people = Person::all();

        foreach ($people as $person) {
            $last_assistance = EntranceExit::where("id_person", $person->id)
                ->where("action", "entrada")
                ->orderBy("date_time", "desc")
                ->first();

            if (!$last_assistance) {
                $last_date = null;
            } else {
                $last_date = Carbon::parse($last_assistance->date_time);
            }

            $days_available = $person->days_available()->pluck('day_english');

            $days_elapsed = 0;
            $iteractive_date = $today->copy();

            while($days_elapsed < 2){
                $iteractive_date->subDay();
                $name_day = $iteractive_date->format("l");

                if ($days_available->contains($name_day)) {
                    $days_elapsed++;
                }
            }

            // if (!$last_date || $last_date->lessThan($iteractive_date)) {
            // }
            if(!$last_date || $last_date->lessThan($iteractive_date)){
                NotificationAbsence::updateOrCreate([
                    'id_person' => $person->id,
                    'last_assistance' => $iteractive_date,
                ],
            [
                'state' => 'pendiente',
                'readed' => false
            ]);

                $this->info($person->name . " tiene inasistencia");

              
                   
                $person->notify(new AbsenceNotification($person));
            }else{
                $this->info($person->name . " NO TIENE tiene inasistencia");
            }

            $this->info('Proceso de verificación de inasistencias completado.');

            // Para poner a funcionar el schedule de los comandos
            // php artisan schedule:work

        }
    }
}
