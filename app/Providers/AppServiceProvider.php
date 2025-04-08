<?php

namespace App\Providers;

use App\Models\DbEntrada\EventLog;
use App\Observers\EventsLogObserver;
use Illuminate\Support\ServiceProvider;

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
    }
}
