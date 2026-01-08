<?php

namespace Database\Seeders;

use App\Models\SscExamPassed;
use Illuminate\Database\Seeder;

class SscExamPassedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->exams() as $key => $name) {
            $exam = new SscExamPassed();
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
            "Matriculation",
            "Equivalent Foreign Qualification",
        ];
        
    }
}
