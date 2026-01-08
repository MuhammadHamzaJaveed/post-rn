<?php

namespace Database\Seeders;

use App\Models\CnicPassport;
use Illuminate\Database\Seeder;

class CnicPassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        foreach ($this->CnicPassport() as $key => $name) {
            $cnicpassport = new CnicPassport();
            $cnicpassport->id = $key + 1;
            $cnicpassport->name = $name;
            $cnicpassport->save();
        }
    }
    public function CnicPassport(): array
    {
        return [
                'CNIC',
                'B-Form',
                'CRC- Child Registration',
                'Passport',
                'POC',
                'NICOP',
                       
        ];
    }
}
