<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class KillSleepQueries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kill:sleep-queries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all sleep queries';

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
            $sleepProcesses = DB::select("SHOW PROCESSLIST");

            foreach ($sleepProcesses as $process) {
                if ($process->Command === 'Sleep') {
                    DB::statement("KILL {$process->Id}");
                }
            }

            return 'Sleeping queries killed successfully.';
        }catch(\Exception $e){
            Log::channel('killsleep')->info($e->getMessage());
        }

    }
}
