<?php

namespace Database\Seeders;

use App\Models\ResidenceArea;
use Illuminate\Database\Seeder;

class ResidenceAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->areas() as $key => $name) {
            $residenceArea = new ResidenceArea();
            $residenceArea->id = $key + 1;
            $residenceArea->name = $name;
            $residenceArea->save();
        }
    }

    /**
     * @return string[]
     */
    public function areas(): array
    {
        return [
            "Urban",
            "Rural",
            "Tribal",
        ];
    }
}
