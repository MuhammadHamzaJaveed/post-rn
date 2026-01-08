<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->genders() as $key => $name) {
            $gender = new Gender();
            $gender->id = $key + 1;
            $gender->name = $name;
            $gender->save();
        }
    }

    /**
     * @return string[]
     */
    public function genders(): array
    {
        return [
            'Male',
            'Female',
            'Other',
        ];
    }
}
