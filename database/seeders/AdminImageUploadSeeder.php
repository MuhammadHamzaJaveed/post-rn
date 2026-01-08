<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminImageUploadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAdminImageUploadUser();

    }

    private function createAdminImageUploadUser()
    {
        User::factory()->verified()->create([
            'email' => 'adminImageUpload@uhs.com',
            'name'  => 'Admin',
            'password' => Hash::make('Private_gFy23'),
        ]);
    }
}
