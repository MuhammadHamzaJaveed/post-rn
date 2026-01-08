<?php

namespace Database\Seeders;

use App\Models\SeatCategory;
use Illuminate\Database\Seeder;

class SeatCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->seatCategories() as $key => $name) {
            $program = new SeatCategory();
            $program->id = $key + 1;
            $program->name = $name;
            $program->save();
        }
    }

    /**
     * @return string[]
     */
    public function seatCategories(): array
    {
        return [
            'Open-Merit',
            'Students with Disabilities',
            'Underdeveloped Districts',
            'Cholistan',
            'Overseas',
            'Reciprocal',
        ];
    }
}
