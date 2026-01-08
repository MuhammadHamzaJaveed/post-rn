<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AzraAndWatimUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCollegeUser();
    }

    private function createCollegeUser(): void
    {
        foreach ($this->colleges() as $key => $collegeData) {
            $user = User::create($collegeData);
            $user->assignRole(config('role_names.roles.college'));
        }
    }

    public function colleges(): array
    {
        return [
            [
                'name' => "Azra Naheed Medical College (Superior University), Lahore",
                'father_name' => "Azra Naheed Medical College (Superior University), Lahore",
                'email' => 'anmc_college@uhs.com',
                'password' => Hash::make('12345678'),
                'college_id' => 2,
            ],
            [
                'name' => "Watim Medical College, Rawalpindi",
                'father_name' => "Watim Medical College, Rawalpindi",
                'email' => 'wmcr_college@uhs.com',
                'password' => Hash::make('12345678'),
                'college_id' => 48,
            ],
        ];
    }
}
