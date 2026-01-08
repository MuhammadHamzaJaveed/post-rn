<?php

namespace Database\Seeders;

use App\Models\Seat;
use App\Models\SeatCategory;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->seats() as $key => $name) {
            $program = new Seat();
            $program->id = $key + 1;
            $program->name = $name;
            $program->save();
        }
    }

    /**
     * @return string[]
     */
    public function seats(): array
    {
        return [
            'Morning',
            'Evening',
            'Both',
        ];
    }
}
