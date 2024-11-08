<?php

namespace App\Providers;

use Illuminate\Console\Scheduling\Schedule;
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
    public function boot(Schedule $schedule): void
    {
        $tasks = config('schedule.tasks', []);

        foreach ($tasks as $frequency => $commands) {
            foreach ($commands as $command) {
                $schedule->command($command)->{$frequency}();
            }
        }
    }
}
