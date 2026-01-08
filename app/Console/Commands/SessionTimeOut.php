<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class SessionTimeOut extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'session:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        try{
            $timeout = 300;
            $currentTime = time();
            $timeLimit = $currentTime - $timeout;

            DB::table('sessions')->where('last_activity', '<', $timeLimit)->delete();
        }catch(\Exception $e){
            Log::channel('sessiontimeout')->info($e->getMessage());
        }

    }
}
