<?php

namespace Database\Seeders;
use App\Models\InstitutionType;
use Illuminate\Database\Seeder;

class InstitutiontypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->institution() as $key => $name) {
            $inst_type = new InstitutionType();
            $inst_type->id = $key + 1;
            $inst_type->name = $name;
            $inst_type->save();
        }
    }
    /**
     * @return string[]
     */
    public function institution(): array
    {
        return [
            'Government',
            'Private',
        ];
    }
}
