<?php

namespace App\Console;

use App\Models\CollegePreference;
use App\Models\User;
use Illuminate\Console\Command;
use PHPUnit\Framework\Constraint\Count;

class CollegePreferences extends Command
{
    protected $signature = 'collegePreferences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get college preferences';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $collegesWithCount = [];
        $compareColleges = [];

        $users = User::query()
            ->with(['mbbsCollegePreferences', 'bdsCollegePreferences'])
            ->where(
                'transaction_id',
                '!=',
                null
            )
            ->where(function ($query) {
                $query->where('program_id', 1)->orWhere(function ($query) {
                    $query->orWhere('program_priority', '=', 1)
                        ->where('program_id', '=', 3);
                });
            });
            dd(count($users));
        $count = [];
        $users->chunk(50, function ($users) use (&$compareColleges, &$collegesWithCount, &$count)  {

            foreach ($users as $user) {
                if (! $user->mbbsCollegePreferences->isEmpty()) {
                    $collegeName = json_decode($user->mbbsCollegePreferences->first()->college_pref, true)[0]['name'];
                    /*                $collegeName = json_decode($collegePreference->college_pref, true)[0]['name'];*/

                    if (isset($compareColleges[$collegeName])) {
                        $compareColleges[$collegeName] = $compareColleges[$collegeName] + 1;
                    } else {
                        $compareColleges[$collegeName] = 1;
                    }

                    if (isset($collegesWithCount[$collegeName])) {
                        $collegesWithCount[$collegeName]['count'] = $compareColleges[$collegeName];
                    } else {
                        $collegesWithCount[$collegeName] = [
                            'name'  => $collegeName,
                            'count' => 0
                        ];
                    }
                } else {
                    $count [] = $user->id;
                }
            }
        });

        usort($collegesWithCount, function($a, $b) {
            return $a['count'] <=> $b['count']; // For PHP 7.0 and above using the spaceship operator
        });

        info('colleges with count are: ', $collegesWithCount);
        dd($users);
        dd($collegesWithCount);
    }
}
