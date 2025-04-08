<?php

namespace App\Observers;

use App\Models\DbEntrada\EventLog;
use Illuminate\Support\Facades\Artisan;

class EventsLogObserver
{
    /**
     * Handle the EventLog "created" event.
     */
    public function created(EventLog $eventLog): void
    {
        if ($eventLog->event_name === 'inasistencias_generadas') {
            Artisan::call('app:send-absence-mails');
        }
    }

    /**
     * Handle the EventLog "updated" event.
     */
    public function updated(EventLog $eventLog): void
    {
        //
    }

    /**
     * Handle the EventLog "deleted" event.
     */
    public function deleted(EventLog $eventLog): void
    {
        //
    }

    /**
     * Handle the EventLog "restored" event.
     */
    public function restored(EventLog $eventLog): void
    {
        //
    }

    /**
     * Handle the EventLog "force deleted" event.
     */
    public function forceDeleted(EventLog $eventLog): void
    {
        //
    }
}
