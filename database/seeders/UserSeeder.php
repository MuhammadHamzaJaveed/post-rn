<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createSuperAdminUser();
       $this->createAdminUser();
        // $this->createSupervisoryTeamUser();
        // $this->createVerificationTeamUser();
        // $this->createInChargeTeamUser();
        // $this->createCollegeUser();
    }

    /**
     * @return void
     */
    private function createSuperAdminUser(): void
    {
        $user = User::factory()->verified()->create([
            'name' => 'Super Admin',
            'email' => 'super_admin@uhs.com',
            'password' => Hash::make('super_admin@1234'),
        ]);

        $this->assignUserRole($user, config('role_names.roles.super_admin'));
    }

    private function createAdminUser(): void
    {
        $user = User::factory()->verified()->create([
            'name' => 'Admin',
            'email' => 'admin@uhs.com',
            'password' => Hash::make('admin1173'),
        ]);

        /*$user2 = User::factory()->verified()->create([
            'email' => 'test@test.com',
            'password' => Hash::make('1234'),
        ]);

        $user3 = User::factory()->verified()->create([
            'name'=>'Zafar Khan',
            'father_name'=>"Pasha khan",
            'email' => 'test3@test.com',
            'password' => Hash::make('1234'),
            'challan_id'=>'523616'
        ]);

        $user4 = User::factory()->verified()->create([
            'name'=>'Maaz Ahmed',
            'father_name'=>"Zulfiqar khan",
            'email' => 'test4@test.com',
            'password' => Hash::make('1234'),
            'challan_id'=>'523576'
        ]);

        $user5 = User::factory()->verified()->create([
            'name'=>'Waseem Akram',
            'father_name'=>"Nasir",
            'email' => 'test5@test.com',
            'password' => Hash::make('1234'),
            'challan_id'=>'523614'
        ]);

        $user6 = User::factory()->verified()->create([
            'name'=>'zeeshan',
            'father_name'=>"Subhan",
            'email' => 'test6@test.com',
            'password' => Hash::make('1234'),
            'challan_id'=>'523589'
        ]);

        $user7 = User::factory()->verified()->create([
            'name'=>'Muhammad Kamil',
            'father_name'=>"Kamil khanday",
            'email' => 'test7@test.com',
            'password' => Hash::make('1234'),
            'challan_id'=>'523618'
        ]);

        $user8 = User::factory()->verified()->create([
            'name'=>'Waqar Ahmed',
            'father_name'=>"Abdulrehman khan",
            'email' => 'test8@test.com',
            'password' => Hash::make('1234'),
            'challan_id'=>'523621'
        ]);

        $user9 = User::factory()->verified()->create([
            'name'=>'Muhammad ali',
            'father_name'=>"Ali",
            'email' => 'test9@test.com',
            'password' => Hash::make('1234'),
            'challan_id'=>'523619'
        ]);

        $user10 = User::factory()->verified()->create([
            'name'=>'Muhammad Usman',
            'father_name'=>"Usman khan",
            'email' => 'test10@test.com',
            'password' => Hash::make('1234'),
            'challan_id'=>'523620'
        ]);

        $user11 = User::factory()->verified()->create([
            'name'=>'shahad',
            'father_name'=>"Sheraz",
            'email' => 'test11@test.com',
            'password' => Hash::make('1234'),
            'challan_id'=>'523622'
        ]);

        $user12 = User::factory()->verified()->create([
            'name'=>'Abdulrehman Khan',
            'father_name'=>"Nasir khan",
            'email' => 'test12@test.com',
            'password' => Hash::make('1234'),
            'challan_id'=>'523623'
        ]);*/
        

        $this->assignUserRole($user, config('role_names.roles.admin'));
        /*$this->assignUserRole($user2, config('role_names.roles.guest'));
        $this->assignUserRole($user3, config('role_names.roles.guest'));
        $this->assignUserRole($user4, config('role_names.roles.guest'));
        $this->assignUserRole($user5, config('role_names.roles.guest'));
        $this->assignUserRole($user6, config('role_names.roles.guest'));
        $this->assignUserRole($user7, config('role_names.roles.guest'));
        $this->assignUserRole($user8, config('role_names.roles.guest'));
        $this->assignUserRole($user9, config('role_names.roles.guest'));
        $this->assignUserRole($user10, config('role_names.roles.guest'));
        $this->assignUserRole($user11, config('role_names.roles.guest'));
        $this->assignUserRole($user12, config('role_names.roles.guest'));*/
    }

    /**
     * @return void
     */
    private function createVerificationTeamUser(): void
    {
        $user = User::factory()->verified()->create([
            'name' => 'Verification Admin',
            'email' => 'verification_admin@uhs.com',
            'password' => Hash::make('12345678'),
        ]);

        $this->assignUserRole($user, config('role_names.roles.verification-team'));
    }

    /**
     * @return void
     */
    private function createInChargeTeamUser(): void
    {
        $user = User::factory()->verified()->create([
            'name' => 'Incharge Admin',
            'email' => 'incharge_admin@uhs.com',
            'password' => Hash::make('1234'),
        ]);

        $this->assignUserRole($user, config('role_names.roles.incharge-team'));
    }

    /**
     * @return void
     */
    private function createSupervisoryTeamUser(): void
    {
        $user = User::factory()->verified()->create([
            'name' => 'Supervisory Admin',
            'email' => 'supervisor_admin@uhs.com',
            'password' => Hash::make('12345678'),
        ]);

        $this->assignUserRole($user, config('role_names.roles.supervisory-team'));
    }

    private function createCollegeUser(): void
    {
        foreach ($this->colleges() as $key => $collegeData) {
            $user = User::create($collegeData);
            $user->assignRole(config('role_names.roles.college'));
        }
    }

    public function colleges(): array
    {
        return [
            [
                'name' => "Islam Dental College, Sialkot",
                'father_name' => "Prof. Mirza Abdul Rauf",
                'email' => 'dentdocadeel.butt@gmail.com',
                'password' => Hash::make('Abc@1234!'),
                'college_id' => 1,
            ],
            [
                'name' => "Avicenna Dental College, Lahore",
                'father_name' => "Prof. Dr. Usman Muneer",
                'email' => 'admissions@avicennamch.com',
                'password' => Hash::make('XyZ#7890@'),
                'college_id' => 2,
            ],
            [
                'name' => "Watim Dental College, Rawalpindi",
                'father_name' => "Prof. Dr. Syed Gulzar Ali Bukhari SI (M), (Retd)",
                'email' => 'nabeela@watim.com.pk',
                'password' => Hash::make('P@ssw0rd!123'),
                'college_id' => 3,
            ],
            [
                'name' => "Faryal Dental College",
                'father_name' => "Prof. Dr. Saad Mateen Munshi",
                'email' => 'saad.mateen@aimec.edu.pk',
                'password' => Hash::make('F@ry@l2025$'),
                'college_id' => 4,
            ],
            [
                'name' => "Dental Section, Multan Medical & Dental College, Multan",
                'father_name' => "Dr. Muhammad Zulfiqar",
                'email' => 'dmemmdcofficial@gmail.com',
                'password' => Hash::make('M@lT@n#123'),
                'college_id' => 5,
            ],
            [
                'name' => "Dental College, Niazi Medical & Dental College, Sargodha",
                'father_name' => "Dr. Mian Farrukh Imran",
                'email' => 'md@nmdc.edu.pk',
                'password' => Hash::make('N!aZ!@3Sarg0'),
                'college_id' => 6,
            ],
            [
                'name' => "Dental Section, FMH College of Medicine & Dentistry, Lahore",
                'father_name' => "Prof. Abid Ashar",
                'email' => 'faisal.izhar@fmhcmd.edu.pk',
                'password' => Hash::make('FMH#2025!'),
                'college_id' => 7,
            ],
            [
                'name' => "Dental Section, University Medical & Dental College, Faisalabad (FEMALE ONLY)",
                'father_name' => "Prof. Dr. Muhammad Akram Malik",
                'email' => 'shirza.nadeem@tuf.edu.pk',
                'password' => Hash::make('F!@S4@b@d#2025'),
                'college_id' => 8,
            ],
            [
                'name' => "Dental College, University College of Medicine & Dentistry, Lahore",
                'father_name' => "Prof. Dr. Mahwish Arooj",
                'email' => 'zaheer.ahmad@ucm.uol.edu.pk',
                'password' => Hash::make('UCM#Lahore@2025'),
                'college_id' => 9,
            ],
            [
                'name' => "Dental Section, Lahore Medical & Dental College, Lahore",
                'father_name' => "Prof. Dr. Aqib Sohail",
                'email' => 'khurram.nadeem@ubas.edu.pk',
                'password' => Hash::make('Lah0r3@2025!'),
                'college_id' => 10,
            ],
            [
                'name' => "Dental Section, Akhtar Saeed Medical & Dental College, Lahore",
                'father_name' => "Prof. Dr. Sabir Hussain",
                'email' => 'principal.dental@amdc.edu.pk',
                'password' => Hash::make('@AmDc#123!'),
                'college_id' => 11,
            ],
            [
                'name' => "Rashid Latif Dental College, Lahore",
                'father_name' => "Prof. Dr. Qasim Saeed",
                'email' => 'principal.ridc@rlmc.edu.pk',
                'password' => Hash::make('R@sh!dL@t1f2025'),
                'college_id' => 12,
            ],
            [
                'name' => "Margalla Institute of Health Sciences, Rawalpindi",
                'father_name' => "Prof. Dr. Amjad Mahmood",
                'email' => 'principal@margalla.edu.pk',
                'password' => Hash::make('M@rg@ll@2025!'),
                'college_id' => 13,
            ],
            [
                'name' => "Dental College, Bakhtawar Amin Medical & Dental College, Multan",
                'father_name' => "Prof. Dr. Muhammad waqar Hussain",
                'email' => 'Prostho.waqar@hotmail.com',
                'password' => Hash::make('B@kht@w@r#2025'),
                'college_id' => 14,
            ],
            [
                'name' => "Azra Naheed Dental College, Lahore",
                'father_name' => "Professor Muhammad Asif Shahzad",
                'email' => 'principal.andc@superior.edu.pk',
                'password' => Hash::make('Azr@N@h33d#2025'),
                'college_id' => 15,
            ],
            [
                'name' => "Shahida Islam Dental College, Lodhran",
                'father_name' => "Prof. Dr. Muhammad Pervaiz Iqbal",
                'email' => 'vice.principal@simc.edu.pk',
                'password' => Hash::make('Sh@h1d@!L0dr@N'),
                'college_id' => 16,
            ],
            [
                'name' => "Dental Section, Sharif Medical & Dental College, Lahore",
                'father_name' => "Prof. Nausheen Raza",
                'email' => 'smdc@sharifmedicalcity.org',
                'password' => Hash::make('Shar!fM3d@L#2025'),
                'college_id' => 17,
            ],
            [
                'name' => "Rahbar College of Dentistry, Lahore",
                'father_name' => "Prof Dr Muhammad Nasir Saleem",
                'email' => 'hinazafarraja@gmail.com',
                'password' => Hash::make('R@hB@rC@L#2025'),
                'college_id' => 18,
            ],
        ];
        
    }

    /**
     * @param User $user
     * @param string $roleName
     * @return void
     */
    private function assignUserRole(User $user, string $roleName): void
    {
        $user->assignRole($roleName);
    }


}
