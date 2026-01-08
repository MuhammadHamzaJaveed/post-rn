<?php

namespace Database\Seeders;

use App\Models\MeritListFromCollege;
use Illuminate\Database\Seeder;

class MeritListFromCollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MeritListFromCollege::create([
            'user_id' => 400014,
            'college_to' => 1,
        ]);

        MeritListFromCollege::create([
            'user_id' => 400015,
            'college_to' => 2,
        ]);

        MeritListFromCollege::create([
            'user_id' => 400016,
            'college_to' => 3,
        ]);
    }
}
