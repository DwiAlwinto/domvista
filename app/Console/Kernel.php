<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('logbook:carry-over')->dailyAt('00:05');
        $schedule->command('leases:check-expired')->dailyAt('00:07');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');

        // ✅ DAFTARKAN SEMUA COMMAND CUSTOM DI SINI (CARA LARAVEL 10)
        $this->commands([
            \App\Console\Commands\CheckExpiredLeases::class,
        ]);
    }
}
