<?php

namespace App\Providers;

use App\Models\DbEntrada\EventLog;
use App\Models\DbProgramacion\Programming as DbProgramacionProgramming;
use App\Observers\EventsLogObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\Programming; // <-- Agrega esta línea
use Illuminate\Support\Facades\View; // <-- Y esta

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        EventLog::observe(EventsLogObserver::class);

        // Compartir el número de programaciones sin registrar
        View::composer('*', function ($view) {
            $programacionesSinRegistrar = DbProgramacionProgramming::where('statu_programming', 'sin_registrar')->count();
            $view->with('programacionesSinRegistrar', $programacionesSinRegistrar);
        });
    }
}
