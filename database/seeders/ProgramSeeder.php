<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->programs() as $key => $name) {
            $program = new Program();
            $program->id = $key + 1;
            $program->name = $name;
            $program->save();
        }
    }

    /**
     * @return string[]
     */
    public function programs(): array
    {
        return [
            'MBBS',
            'BDS',
            /*'MBBS & BDS',*/
        ];
    }
}
