<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
      Commands\estadoserver::class,
      Commands\bytesxdia::class,
      Commands\usuarioxdia::class,
      Commands\mostapxdia::class,
      Commands\roguedevices::class,
      Commands\wlanxdia::class,
      Commands\terminationsurveyxnps::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      $schedule->command('estado:server')->dailyAt('22:00');
      $schedule->command('usuario:dia')->dailyAt('22:10');
      $schedule->command('bytes:dia')->dailyAt('22:20');
      $schedule->command('ap:dia')->dailyAt('22:30');
      $schedule->command('wlan:dia')->dailyAt('22:40');
      $schedule->command('rougue:mes')->monthly();
      $schedule->command('survey:nps')->monthly(1,'10:30');
      $schedule->command('survey:especial')->monthly(1,'11:00');
      $schedule->command('termination:nps')->daily();
      $schedule->command('ticket:monthly')->weekly()->sundays()->at('23:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
