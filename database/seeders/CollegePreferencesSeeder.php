<?php

namespace Database\Seeders;
use App\Models\CollegePreference;
use Illuminate\Database\Seeder;

class CollegePreferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
            foreach ($this->CollegePreferences() as $key => $collegeData) {
                $collegePref = new CollegePreference;
                $collegePref->id = $key + 1;
                $collegePref->college_pref = $collegeData['college_pref'];
                $collegePref->session_id = $collegeData['session_id']; // Set district data
                $collegePref->save();
            }    
    }

    
    /**
     * @return string[]
     */
    public function CollegePreferences(): array
    {
        return [
            [
                'user_id' => 1,
                'college_pref' => '[{"id":1,"name":"D.G. Khan Medical College (DGKMC), D.G Khan"},{"id":2,"name":"Ameer-ud-Din Medical College (AMC), Lahore"},{"id":3,"name":"Gujranwala Medical College (GMC), Gujranwala"},{"id":4,"name":"King Edward Medical University (KEMC), Lahore"}]',
                'session_id' => 1,
            ],        
        ];
    }
}
