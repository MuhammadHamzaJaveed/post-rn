<?php

namespace Database\Seeders;

use App\Models\College;
use Illuminate\Database\Seeder;

class WatimMedicalCollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->colleges() as $key => $collegeData) {
            $college = new College();
            $college->name = $collegeData['name'];
            $college->district = $collegeData['district']; // Set district data
            $college->openMeritSeats = $collegeData['openMeritSeats'];
            $college->overSeasSeats = $collegeData['overSeasSeats'];
            $college->disabilitySeats = $collegeData['disabilitySeats'];
            $college->cholistanSeats = $collegeData['cholistanSeats'];
            $college->isReciprocal = $collegeData['isReciprocal'];
            $college->isBds = $collegeData['isBds'];
            $college->isFemale = $collegeData['isFemale'];
            $college->underdevelopedAreas = $collegeData['underdevelopedAreas'];
            $college->save();
        }
    }


    public function colleges(): array
    {
        return [
            [
                'name' => "Watim Medical College, Rawalpindi",
                'district' => " Rawalpindi",
                'openMeritSeats' => 100,
                'overSeasSeats' => 0,
                'underdevelopedAreas' => 0,
                'disabilitySeats' => 0,
                'cholistanSeats' => 0,
                'isReciprocal' => 0,
                'isBds' => 0,
                'isFemale' => 0,
            ],
        ];
    }
}
