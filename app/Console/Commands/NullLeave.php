<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employees\LeaveAllotment;

class NullLeave extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leave:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update leave balance of an employee after every month and after taking leave.';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        LeaveAllotment::where('leave_mast_id', 9)->update(['initial_bal', 0]);
    }
}
