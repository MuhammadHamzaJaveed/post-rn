<?php

namespace Database\Seeders;

use App\Models\ExamPassed;
use Illuminate\Database\Seeder;

class ExamPassedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->exams() as $key => $name) {
            $exam = new ExamPassed();
            $exam->id = $key + 1;
            $exam->name = $name;
            $exam->save();
        }
    }

    /**
     * @return string[]
     */
    public function exams(): array
    {
        return [
            "Intermediate",
            "Equivalent Foreign Qualification",
        ];
        
    }
}
