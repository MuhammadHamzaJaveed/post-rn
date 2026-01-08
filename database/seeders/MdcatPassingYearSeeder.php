<?php

namespace Database\Seeders;
use App\Models\MdcatPassingYear;
use Illuminate\Database\Seeder;

class MdcatPassingYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        foreach ($this->mdcatyears() as $key => $name) {
            $mdcat_center = new MdcatPassingYear();
            $mdcat_center->id = $key + 1;
            $mdcat_center->name = $name;
            $mdcat_center->save();
        }
    }
    /**
     * @return string[]
     */
    public function mdcatyears(): array
    {
        return [
            '2023',
            '2024',
        ];
    }
}
