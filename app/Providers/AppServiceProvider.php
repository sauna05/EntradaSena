<?php

namespace App\Providers;

use App\Models\DbEntrada\EventLog;
use App\Models\DbProgramacion\Programming as DbProgramacionProgramming;
use App\Observers\EventsLogObserver;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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

        // Compartir notificaciones globalmente
        View::composer('*', function ($view) {
            $now = Carbon::now();

            // Programaciones sin registrar
            $programacionesSinRegistrar = DbProgramacionProgramming::where('statu_programming', 'sin_registrar')->count();

            // Programaciones finalizadas recientemente (últimos 7 días)
            // Considerando la fecha y hora real de finalización
            $programacionesFinalizadas = DbProgramacionProgramming::where('statu_programming', 'finalizada_evaluada')
                ->where('end_date', '>=', $now->copy()->subDays(7))
                ->where('end_date', '<=', $now) // Solo las que ya finalizaron
                ->count();

            // Programaciones que finalizan hoy - CORREGIDO
            // Considera la hora exacta de finalización
            $programacionesFinalizanHoy = DbProgramacionProgramming::where('statu_programming', '!=', 'finalizada_evaluada')
                ->whereDate('end_date', $now->toDateString()) // Misma fecha
                ->where('end_date', '>', $now) // Pero que aún no han finalizado (hora futura)
                ->count();

            // Programaciones que YA deberían haber finalizado hoy pero no están marcadas - NUEVA CATEGORÍA
            $programacionesPendientesHoy = DbProgramacionProgramming::where('statu_programming', '!=', 'finalizada_evaluada')
                ->whereDate('end_date', $now->toDateString()) // Misma fecha
                ->where('end_date', '<=', $now) // Pero que ya deberían haber finalizado (hora pasada)
                ->count();

            // Programaciones próximas a finalizar (en los próximos 3 días) - CORREGIDO
            $programacionesProximas = DbProgramacionProgramming::where('statu_programming', '!=', 'finalizada_evaluada')
                ->where('end_date', '>', $now) // Aún no finalizadas
                ->where('end_date', '<=', $now->copy()->addDays(3)) // En los próximos 3 días
                ->count();

            // Programaciones en curso - NUEVA CATEGORÍA ÚTIL
            $programacionesEnCurso = DbProgramacionProgramming::where('statu_programming', '!=', 'finalizada_evaluada')
                ->where('start_date', '<=', $now) // Ya empezaron
                ->where('end_date', '>', $now) // Aún no finalizan
                ->count();

            $view->with([
                'programacionesSinRegistrar' => $programacionesSinRegistrar,
                'programacionesFinalizadas' => $programacionesFinalizadas,
                'programacionesFinalizanHoy' => $programacionesFinalizanHoy,
                'programacionesPendientesHoy' => $programacionesPendientesHoy, // Nueva
                'programacionesProximas' => $programacionesProximas,
                'programacionesEnCurso' => $programacionesEnCurso, // Nueva
                'totalNotificaciones' => $programacionesSinRegistrar +
                    $programacionesFinalizadas +
                    $programacionesFinalizanHoy +
                    $programacionesPendientesHoy +
                    $programacionesProximas
            ]);
        });
    }
}
