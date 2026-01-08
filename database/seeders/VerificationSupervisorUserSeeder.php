<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VerificationSupervisorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            $this->createVerificationTeamUser();
            $this->createVerificationSupervisorUser();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error("Seeding failed: {$e->getMessage()}");
        }
    }


    private function createVerificationSupervisorUser(): void
    {
        foreach ($this->createVerificationTeamSupervisorUsers() as $key => $collegeData) {
            $user = User::factory()->verified()->create($collegeData);
            $user->assignRole(config('role_names.roles.supervisory-team'));
        }

    }
    private function createVerificationTeamSupervisorUsers(): array
    {
        return
            [
                [
                    'name'=>'Supervisor 1',
                    'father_name'=> "Supervisor1",
                    'email' => 'super1@uhs.com',
                    'password' => Hash::make('uhssuper1')
                ],
                [
                    'name'=>'Supervisor 2',
                    'father_name'=> "Supervisor2",
                    'email' => 'super2@uhs.com',
                    'password' => Hash::make('uhssuper2'),
                ],
                [
                    'name'=>'Supervisor 3',
                    'father_name'=> "Supervisor3",
                    'email' => 'super3@uhs.com',
                    'password' => Hash::make('uhssuper3')
                ],
                [
                    'name'=>'Supervisor 4',
                    'father_name'=> "Supervisor4",
                    'email' => 'super4@uhs.com',
                    'password' => Hash::make('uhssuper4')
                ],
                [
                    'name'=>'Supervisor 5',
                    'father_name'=> "Supervisor5",
                    'email' => 'super5@uhs.com',
                    'password' => Hash::make('uhssuper5')
                ],
                [
                    'name'=>'Supervisor 6',
                    'father_name'=> "Supervisor6",
                    'email' => 'super6@uhs.com',
                    'password' => Hash::make('uhssuper6')
                ],
            ];
    }


    private function createVerificationTeamUser(): void
    {
        foreach ($this->createVerificationTeamUsers() as $key => $collegeData) {
            $user = User::factory()->verified()->create($collegeData);
            $user->assignRole(config('role_names.roles.verification-team'));
        }
    }
    private function createVerificationTeamUsers(): array
    {
        return
            [
                [
                    'name'=>'Verification 1',
                    'father_name'=> "Verification1",
                    'email' => 'verification1@uhs.com',
                    'password' => Hash::make('uhsvt1')
                ],
                [
                    'name'=>'Verification 2',
                    'father_name'=> "Verification2",
                    'email' => 'verification2@uhs.com',
                    'password' => Hash::make('uhsvt2'),
                ],
                [
                    'name'=>'Verification 3',
                    'father_name'=> "Verification3",
                    'email' => 'verification3@uhs.com',
                    'password' => Hash::make('uhsvt3')
                ],
                [
                    'name'=>'Verification 4',
                    'father_name'=> "Verification4",
                    'email' => 'verification4@uhs.com',
                    'password' => Hash::make('uhsvt4')
                ],
                [
                    'name'=>'Verification 5',
                    'father_name'=> "Verification5",
                    'email' => 'verification5@uhs.com',
                    'password' => Hash::make('uhsvt5')
                ],
                [
                    'name'=>'Verification 6',
                    'father_name'=> "Verification6",
                    'email' => 'verification6@uhs.com',
                    'password' => Hash::make('uhsvt6')
                ],
                [
                    'name'=>'Verification 7',
                    'father_name'=> "Verification7",
                    'email' => 'verification7@uhs.com',
                    'password' => Hash::make('uhsvt7')
                ],
                [
                    'name'=>'Verification 8',
                    'father_name'=> "Verification8",
                    'email' => 'verification8@uhs.com',
                    'password' => Hash::make('uhsvt8')
                ],
                [
                    'name'=>'Verification 9',
                    'father_name'=> "Verification9",
                    'email' => 'verification9@uhs.com',
                    'password' => Hash::make('uhsvt9')
                ],
                [
                    'name'=>'Verification 10',
                    'father_name'=> "Verification10",
                    'email' => 'verification10@uhs.com',
                    'password' => Hash::make('uhsvt10')
                ],
                [
                    'name'=>'Verification 11',
                    'father_name'=> "Verification11",
                    'email' => 'verification11@uhs.com',
                    'password' => Hash::make('uhsvt11')
                ],
                [
                    'name'=>'Verification 12',
                    'father_name'=> "Verification12",
                    'email' => 'verification12@uhs.com',
                    'password' => Hash::make('uhsvt12')
                ],
                [
                    'name'=>'Verification 13',
                    'father_name'=> "Verification13",
                    'email' => 'verification13@uhs.com',
                    'password' => Hash::make('uhsvt13')
                ],
                [
                    'name'=>'Verification 14',
                    'father_name'=> "Verification14",
                    'email' => 'verification14@uhs.com',
                    'password' => Hash::make('uhsvt14')
                ],
                [
                    'name'=>'Verification 15',
                    'father_name'=> "Verification15",
                    'email' => 'verification15@uhs.com',
                    'password' => Hash::make('uhsvt15')
                ],
                [
                    'name'=>'Verification 16',
                    'father_name'=> "Verification16",
                    'email' => 'verification16@uhs.com',
                    'password' => Hash::make('uhsvt16')
                ],
                [
                    'name'=>'Verification 17',
                    'father_name'=> "Verification17",
                    'email' => 'verification17@uhs.com',
                    'password' => Hash::make('uhsvt17')
                ],
                [
                    'name'=>'Verification 18',
                    'father_name'=> "Verification18",
                    'email' => 'verification18@uhs.com',
                    'password' => Hash::make('uhsvt18')
                ],
                [
                    'name'=>'Verification 19',
                    'father_name'=> "Verification19",
                    'email' => 'verification19@uhs.com',
                    'password' => Hash::make('uhsvt19')
                ],
                [
                    'name'=>'Verification 20',
                    'father_name'=> "Verification20",
                    'email' => 'verification20@uhs.com',
                    'password' => Hash::make('uhsvt20')
                ]
            ];
    }
}
