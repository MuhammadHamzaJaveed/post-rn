<?php

namespace Database\Seeders;
use App\Models\MdcatCenter;
use Illuminate\Database\Seeder;

class MdcatCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        foreach ($this->mdcatcenter() as $key => $name) {
            $mdcat_center = new MdcatCenter();
            $mdcat_center->id = $key + 1;
            $mdcat_center->name = $name;
            $mdcat_center->save();
        }
    }
    /**
     * @return string[]
     */
    public function mdcatcenter(): array
    {
        return [
            'Balochistan',
            'Sindh',
            'KPK',
            'Azad Jammu & Kashmir',
            'Gilgit Baltistan',
            'Punjab',
            'SZABMU,ISLAMABAD',
            'International Venue [a. RIYADH]',
            'International Venue [b. DUBAI]',
        ];
    }
}
