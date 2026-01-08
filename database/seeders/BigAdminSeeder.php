<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BigAdminSeeder extends Seeder
{
    public function run()
    {
        $this->createBigAdminUser();
    }

    private function createBigAdminUser()
    {
        User::factory()->verified()->create([
            'email' => 'adminbig@uhs.com',
            'password' => Hash::make('gFy69_vcF'),
        ]);
    }
}
