<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discipline;

class DisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
    public function run()
    {
   $disciplines = [
    ['name' => 'LAHORE', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'GUJRANWALA', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'HAFIZABAD', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'NANKANA SAHIB', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'SHEIKHUPURA', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'MULTAN', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'LODHRAN', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'MUZAFFARGARH', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'OKARA', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'KASUR', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'BAHAWALPUR', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'RAHIM YAR KHAN', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'SIALKOT', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'GUJRAT', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'MANDI BAHAUDDIN', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'NAROWAL', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'DERA GHAZI KHAN', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'RAJANPUR', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'BHAKKAR', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'BAHAWALNAGAR', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'VEHARI', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'PAKPATTAN', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'CHAKWAL', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'SARGODHA', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'MIANWALI', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'SAHIWAL', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'KHANEWAL', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'TOBA TEK SINGH', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'ATTOCK', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'RAWALPINDI', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'JHELUM', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'JHANG', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'FAISALABAD', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'KHUSHAB', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'CHINIOT', 'seat_id' => 1, 'is_active' => true],
    ['name' => 'LAYYAH', 'seat_id' => 1, 'is_active' => true],
];

        foreach ($disciplines as $discipline) {
            Discipline::create($discipline);
        }
    }
}
