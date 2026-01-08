<?php

namespace App\Console;

use App\Models\User;
use Illuminate\Console\Command;

class UsersWithoutCollegePreferences extends Command
{
    protected $signature = 'usersWithoutCollegePreferences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get users without college preferences';

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
        $usersWithoutCollegePreferences = [];

        $users = User::query()
            ->with(['mbbsCollegePreferences', 'bdsCollegePreferences'])
            ->where(
                'submitted_at',
                '!=',
                null
            )
            ->where(
                'transaction_id',
                '!=',
                null
            );

        $users->chunk(50, function ($users) use (&$usersWithoutCollegePreferences) {
            foreach ($users as $user) {
               if ($user->bdsCollegePreferences->isEmpty() && $user->mbbsCollegePreferences->isEmpty())
               {
                   $usersWithoutCollegePreferences[] = $user->id;
               }
            }
        });

        info('Total Users without college preferences are: '.count($usersWithoutCollegePreferences));
        info('Users without college preferences are: ', $usersWithoutCollegePreferences);
    }
}
