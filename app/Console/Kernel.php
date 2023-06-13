<?php

namespace App\Console;

use App\Console\Commands\TestCron;
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
     \App\Console\Commands\UpdateLeaveBalance::class
                ];
                
   protected function scheduleTimezone()
   {
      return 'Asia/Kolkata';
   }

   /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */ 
   protected function schedule(Schedule $schedule)
   {

      //Update leave balance 1st day of every month.
      // $schedule->call('App\Http\Controllers\HRD\LeavesController@updateLeaveBalance')->monthlyOn(1, '0:00');
      //$schedule->call('App\Http\Controllers\HRD\LeavesController@nullLeave')->yearly();
        // For Reminders 
      // $schedule->call('App\Http\Controllers\PMS\Agenda\AgendaMastController@agenda_reminder')->everyThirtyMinutes();
     // $schedule->call('App\Http\Controllers\PMS\Schedule\ScheduleController@display_reminder')->dailyAt('10:15');
     // $schedule->call('App\Http\Controllers\PMS\Schedule\ScheduleController@BirthdaySchedule')->dailyAt('10:11');
    //$schedule->call('App\Http\Controllers\HRD\LeavesController@updateLeaveBalance')->dailyAt('16:28');

     // $schedule->call('App\Http\Controllers\PMS\TasksController@missed_tasks_alert')->dailyAt('10:00');
     // $schedule->call('App\Http\Controllers\PMS\TasksController@update_task_as_missed')->dailyAt('23:00');

      // For DB Entries
     // $schedule->call('App\Http\Controllers\PMS\Agenda\AgendaResponseController@enter_agenda_missed')->dailyAt('23:30');

      //$schedule->call('App\Http\Controllers\PMS\AgendaController@pause_agenda_entry')->dailyAt('1:00');

      // For Update Queries
     // $schedule->call('App\Http\Controllers\PMS\TasksController@updateExpiredTask')->hourlyAt(10);
      // $schedule->call('App\Http\Controllers\PMS\ScheduleController@expired_displays')->weeklyOn(1,'1:00'); //insert history

      // For Cleanups
      // $schedule->call('App\Http\Controllers\Admin\MainController@deleteNotifications')->weekly();
      //$schedule->call('App\Http\Controllers\HRD\LeavesController@updateLeaveBalance')->dailyAt('14:30');
                   //->monthlyOn(1, '0:00')
                  //->monthlyOn(4, '15:00');

      //$schedule->command('test:cron')->everyMinute();
      $schedule->command('leave:update')->monthlyOn(1, '0:00');
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
