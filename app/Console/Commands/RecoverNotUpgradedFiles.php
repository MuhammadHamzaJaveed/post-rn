<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MeritListFromCollege;
use Illuminate\Support\Facades\Storage;

class RecoverNotUpgradedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recover:not-upgraded-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update joining reports for not upgraded users';

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
        $ml = MeritListFromCollege::whereColumn('college_from','college_to')
            ->get();

        echo count($ml)."\n";

        // foreach($ml as $record) {
        //     echo $record."\n";
        // }
        

        foreach ($ml as $record) {
            $userId = $record->user_id;
            $college_report = $userId."_images/college_report/";
            $student_report = $userId."_images/student-report/";

            if (Storage::exists($college_report)) {
                $files = Storage::files($college_report);
                if (!empty($files)) {
                    $latestFile = collect($files)
                        ->sortByDesc(fn($file) => Storage::lastModified($file))
                        ->first();

                    MeritListFromCollege::where('id',$record->id)
                        ->update([
                            'college_affidavit_path' => $latestFile
                        ]);
                } 
            }

            if (Storage::exists($student_report)) {
                $files = Storage::files($student_report);
                if (!empty($files)) {
                    $latestFile = collect($files)
                        ->sortByDesc(fn($file) => Storage::lastModified($file))
                        ->first();

                    MeritListFromCollege::where('id',$record->id)
                        ->update([
                            'student_affidavit_path' => $latestFile,
                            'is_joined' => 1
                        ]);
                } 
            }
            echo $userId." done\n";
        }
    }
}
