<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ProgramSeeder::class,
            SeatCategorySeeder::class,
            SeatSeeder::class,
            GenderSeeder::class,
            NationalitySeeder::class,
            ResidenceAreaSeeder::class,
            DistrictSeeder::class,
            DisciplineSeeder::class,
            BoardsSeeder::class,
            ExamPassedSeeder::class,
            CollegeSeeder::class,
            InstitutiontypeSeeder::class,
            MdcatCenterSeeder::class,
            CnicPassportSeeder::class,
            SscExamPassedSeeder::class,
            MdcatPassingYearSeeder::class,
        ]);
    }
}
