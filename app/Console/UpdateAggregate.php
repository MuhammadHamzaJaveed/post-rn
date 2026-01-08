<?php

namespace App\Console;

use DB;
use App\Models\User;
use App\Models\Qualification;
use App\Models\AdmissionTest;
use Illuminate\Console\Command;

class UpdateAggregate extends Command
{
    protected $userServices;
    protected $signature = 'updateAggregate';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all general Aggregates (Open merit only)';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*
    * @param  UserServices  $userServices
    * @return void
    */
//    public function boot(UserServices $userServices): void
//    {
       
//    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {

        $users = User::query()
            ->where(
                'transaction_id',
                '!=',
                null
            );

        $count = [];
        $users->chunk(50, function ($users) {
            foreach ($users as $user) {
                $oldAggregate = $user->aggregate;
                $generalAggregate  = $this->calculateAggregate($user);
                
                // $users->where($user->id)->update([]);
                // $this->userServices->updateUser(['aggregate'=>$generalAggregate],$user->id);
                DB::table('users')->where('id', '>',112562)->where('id',$user->id)->update(['aggregate'=>$generalAggregate]);

                if($oldAggregate == $generalAggregate)
                    print("\n\r".'No change for User ID: \t'.$user->id.'\tOld Aggregate:\t'.$oldAggregate.'\tNew:\t'.$generalAggregate."\n\r");
                else
                    print("\n\r".'Updating User ID: \t'.$user->id.'\tOld Aggregate:\t'.$oldAggregate.'\tNew:\t'.$generalAggregate."\n\r");
            }
        });
    }

    private function calculateAggregate($currentUser)
    { print("\n\r".$currentUser->id."\n\r");
        
        $admissionTestModel = new AdmissionTest;
        $qualificationModel = new Qualification;
        
        $qualifications = $qualificationModel->where('user_id','=',$currentUser->id)->first();
        $admissionTest  = $admissionTestModel->where('user_id','=',$currentUser->id)->first();

        $sscObtainedMarks = $qualifications->ssc_marks_obtained;
        $hsscObtainedMarks = $qualifications->hssc_marks_obtained;

        $mdCatObtainedMarks = $admissionTest->md_cat_obtained_marks;

        $programId = $currentUser->program_id;

        if (
            ($sscObtainedMarks && $hsscObtainedMarks) &&
            ($mdCatObtainedMarks)
        ) {
            $averageTotal = 1100;

            $ssc =  $sscObtainedMarks / $qualifications->ssc_total_marks * $averageTotal * 0.10;
            $hssc = $hsscObtainedMarks / $qualifications->hssc_total_marks * $averageTotal * 0.40;

            $aggregation = [];

            $mdCatPercentile = $mdCatObtainedMarks / 200 * 100;

        if ($mdCatObtainedMarks) {
            $mdCat = $mdCatObtainedMarks / 200 * $averageTotal * 0.50;

            $aggregation['mdCat'] = ($ssc + $hssc + $mdCat) / $averageTotal * 100;
        }

            $maxAggregate = round(max($aggregation),4);


            return $maxAggregate;
        } else {
            return 0;
        }
    }


    private function calculateOverseasAggregate()
    {
        

        $qualifications = auth()->user()->qualifications;
        $admissionTest = auth()->user()->admissionTest;

        $sscObtainedMarks = $qualifications->ssc_marks_obtained;
        $hsscObtainedMarks = $qualifications->hssc_marks_obtained;

        $mCatObtainedMarks = $admissionTest->mcat_obtained_marks;
        $mdCatObtainedMarks = $admissionTest->md_cat_obtained_marks;
        $uCatObtainedMarks = $admissionTest->ucat_obtained_marks;
        $satObtainedMarks = ($admissionTest->sat_biology_obtained_marks * 0.40) + 
            ($admissionTest->sat_chemistry_obtained_marks * 0.35) +
            ($admissionTest->sat_phy_math_obtained_marks * 0.25); 

        $programId = auth()->user()->program_id;

        if (
            ($sscObtainedMarks && $hsscObtainedMarks) &&
            ($mdCatObtainedMarks || $uCatObtainedMarks || $satObtainedMarks || $mCatObtainedMarks)
        ) {
            $averageTotal = 1100;

            $ssc =  $sscObtainedMarks / $qualifications->ssc_total_marks * $averageTotal * 0.10;
            $hssc = $hsscObtainedMarks / $qualifications->hssc_total_marks * $averageTotal * 0.40;

            $aggregation = [];

            $mdCatPercentile = $mdCatObtainedMarks / 200 * 100;

            if ((
                ($programId == 1 || $programId == 3) && $mdCatPercentile >= 55) ||
                ($programId == 2 && $mdCatPercentile >= 50))
            {
                if ($mdCatObtainedMarks) {
                    $mdCat = $mdCatObtainedMarks / 200 * $averageTotal * 0.50;

                    $aggregation['mdCat'] = ($ssc + $hssc + $mdCat) / $averageTotal * 100 ;
                }
            } else {
                $aggregation['mdCat'] = 0;
            }

            if ($uCatObtainedMarks) {
                $uCat = $uCatObtainedMarks / 3600 * $averageTotal * 0.50;

                $aggregation['uCat'] = ($ssc + $hssc + $uCat) / $averageTotal * 100 ;
            }

            if ($satObtainedMarks) {
                $sat2 = $satObtainedMarks / 800 * $averageTotal * 0.50;

                $aggregation['sat2'] = ($ssc + $hssc + $sat2) / $averageTotal * 100 ;
            }

            if ($mCatObtainedMarks) {
                $mCat = $mCatObtainedMarks / 528 * $averageTotal * 0.50;
        
                $aggregation['mCat'] = ($ssc + $hssc + $mCat) / $averageTotal * 100;
            }

            $maxAggregate = max($aggregation);


            return $maxAggregate;
        } else {
            return 0;
        }
    }
}
