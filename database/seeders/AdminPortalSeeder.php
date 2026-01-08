<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminPortalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createSupervisoryTeamUser();
        $this->createVerificationTeamUser();
        $this->createInChargeTeamUser();
        $this->createAdminUser();
    }

    /**
     * @return void
     */
    private function createAdminUser(): void
    {
        $user = User::factory()->verified()->create([
            'name' =>'Admin',
            'email' => 'admin@uhs.com',
            'password' => Hash::make('89FdCvxg8V'),
        ]);

        $this->assignUserRole($user, config('role_names.roles.admin'));
    }

    /**
     * @return void
     */
    private function createVerificationTeamUser(): void
    {
        $user = User::factory()->verified()->create([
            'name' =>'Admin Verification',
            'email' => 'adminverification@uhs.com',
            'password' => Hash::make('CtTq388bNT'),
        ]);

        $user1 = User::factory()->verified()->create([
            'name' =>'vt1@uhs.com',
            'email' => 'vt1@uhs.com',
            'password' => Hash::make('74asC52Xgq'),
        ]);

        $user2 = User::factory()->verified()->create([
            'name' =>'vt2@uhs.com',
            'email' => 'vt2@uhs.com',
            'password' => Hash::make('c2W2R8Sx2E'),
        ]);

        $user3 = User::factory()->verified()->create([
            'name' =>'vt3@uhs.com',
            'email' => 'vt3@uhs.com',
            'password' => Hash::make('93NYGPP6qm'),
        ]);

        $user4 = User::factory()->verified()->create([
            'name' =>'vt4@uhs.com',
            'email' => 'vt4@uhs.com',
            'password' => Hash::make('T7RCg4j3qU'),
        ]);

        $user5 = User::factory()->verified()->create([
            'name' =>'vt5@uhs.com',
            'email' => 'vt5@uhs.com',
            'password' => Hash::make('7ckR53zhK3'),
        ]);

        $user6 = User::factory()->verified()->create([
            'name' =>'vt6@uhs.com',
            'email' => 'vt6@uhs.com',
            'password' => Hash::make('n8rM47tpNt'),
        ]);

        $user7 = User::factory()->verified()->create([
            'name' =>'vt7@uhs.com',
            'email' => 'vt7@uhs.com',
            'password' => Hash::make('K6fQR5Bz26'),
        ]);

        $user8 = User::factory()->verified()->create([
            'name' =>'vt8@uhs.com',
            'email' => 'vt8@uhs.com',
            'password' => Hash::make('72y45E7VR8'),
        ]);

        $user9 = User::factory()->verified()->create([
            'name' =>'vt9@uhs.com',
            'email' => 'vt9@uhs.com',
            'password' => Hash::make('TpR548G8aN'),
        ]);

        $user10 = User::factory()->verified()->create([
            'name' =>'vt10@uhs.com',
            'email' => 'vt10@uhs.com',
            'password' => Hash::make('nW7C3jB27b'),
        ]);

        $user11 = User::factory()->verified()->create([
            'name' =>'vt11@uhs.com',
            'email' => 'vt11@uhs.com',
            'password' => Hash::make('59E4NstDvZ'),
        ]);

        $user12 = User::factory()->verified()->create([
            'name' =>'vt12@uhs.com',
            'email' => 'vt12@uhs.com',
            'password' => Hash::make('4tH2dg8nuV'),
        ]);

        $user13 = User::factory()->verified()->create([
            'name' =>'vt13@uhs.com',
            'email' => 'vt13@uhs.com',
            'password' => Hash::make('6Nm62F9ttQ'),
        ]);

        $user14 = User::factory()->verified()->create([
            'name' =>'vt14@uhs.com',
            'email' => 'vt14@uhs.com',
            'password' => Hash::make('f7D6636GjW'),
        ]);

        $user15 = User::factory()->verified()->create([
            'name' =>'vt15@uhs.com',
            'email' => 'vt15@uhs.com',
            'password' => Hash::make('nx4DQ63R3M'),
        ]);

        $user16 = User::factory()->verified()->create([
            'name' =>'vt16@uhs.com',
            'email' => 'vt16@uhs.com',
            'password' => Hash::make('S3Hg5zqkY7'),
        ]);

        $user17 = User::factory()->verified()->create([
            'name' =>'vt17@uhs.com',
            'email' => 'vt17@uhs.com',
            'password' => Hash::make('R4TyZE7S53'),
        ]);

        $user18 = User::factory()->verified()->create([
            'name' =>'vt18@uhs.com',
            'email' => 'vt18@uhs.com',
            'password' => Hash::make('zQ85A78cdM'),
        ]);

        $user19 = User::factory()->verified()->create([
            'name' =>'vt19@uhs.com',
            'email' => 'vt19@uhs.com',
            'password' => Hash::make('6T6A2NxReA'),
        ]);

        $user20 = User::factory()->verified()->create([
            'name' =>'vt20@uhs.com',
            'email' => 'vt20@uhs.com',
            'password' => Hash::make('T5ZD8En4y5'),
        ]);

        $user21 = User::factory()->verified()->create([
            'name' =>'vt21@uhs.com',
            'email' => 'vt21@uhs.com',
            'password' => Hash::make('PP93d7XARd'),
        ]);


        $user22 = User::factory()->verified()->create([
            'name' =>'vt22@uhs.com',
            'email' => 'vt22@uhs.com',
            'password' => Hash::make('d3bJAC836G'),
        ]);

        $user23 = User::factory()->verified()->create([
            'name' =>'vt23@uhs.com',
            'email' => 'vt23@uhs.com',
            'password' => Hash::make('tHQ39Ky8P9'),
        ]);

        $user24 = User::factory()->verified()->create([
            'name' =>'vt24@uhs.com',
            'email' => 'vt24@uhs.com',
            'password' => Hash::make('xV56bg6Sbg'),
        ]);

        $user25 = User::factory()->verified()->create([
            'name' =>'vt25@uhs.com',
            'email' => 'vt25@uhs.com',
            'password' => Hash::make('98jBruMwB2'),
        ]);

        $user26 = User::factory()->verified()->create([
            'name' =>'vt26@uhs.com',
            'email' => 'vt26@uhs.com',
            'password' => Hash::make('7Zsq3P5dmU'),
        ]);

        $user27 = User::factory()->verified()->create([
            'name' =>'vt27@uhs.com',
            'email' => 'vt27@uhs.com',
            'password' => Hash::make('8pEjTbJ4h5'),
        ]);

        $user28 = User::factory()->verified()->create([
            'name' =>'vt28@uhs.com',
            'email' => 'vt28@uhs.com',
            'password' => Hash::make('5ADpkHN99B'),
        ]);
        $user29 = User::factory()->verified()->create([
            'name' =>'vt29@uhs.com',
            'email' => 'vt29@uhs.com',
            'password' => Hash::make('8X3b83Srjf'),
        ]);

        $user30 = User::factory()->verified()->create([
            'name' =>'vt30@uhs.com',
            'email' => 'vt30@uhs.com',
            'password' => Hash::make('68AE4xpaXS'),
        ]);
        $this->assignUserRole($user, config('role_names.roles.verification-team'));
        $this->assignUserRole($user1, config('role_names.roles.verification-team'));
        $this->assignUserRole($user2, config('role_names.roles.verification-team'));
        $this->assignUserRole($user3, config('role_names.roles.verification-team'));
        $this->assignUserRole($user4, config('role_names.roles.verification-team'));
        $this->assignUserRole($user5, config('role_names.roles.verification-team'));
        $this->assignUserRole($user6, config('role_names.roles.verification-team'));
        $this->assignUserRole($user7, config('role_names.roles.verification-team'));
        $this->assignUserRole($user8, config('role_names.roles.verification-team'));
        $this->assignUserRole($user9, config('role_names.roles.verification-team'));
        $this->assignUserRole($user10, config('role_names.roles.verification-team'));
        $this->assignUserRole($user11, config('role_names.roles.verification-team'));
        $this->assignUserRole($user12, config('role_names.roles.verification-team'));
        $this->assignUserRole($user13, config('role_names.roles.verification-team'));
        $this->assignUserRole($user14, config('role_names.roles.verification-team'));
        $this->assignUserRole($user15, config('role_names.roles.verification-team'));
        $this->assignUserRole($user16, config('role_names.roles.verification-team'));
        $this->assignUserRole($user17, config('role_names.roles.verification-team'));
        $this->assignUserRole($user18, config('role_names.roles.verification-team'));
        $this->assignUserRole($user19, config('role_names.roles.verification-team'));
        $this->assignUserRole($user20, config('role_names.roles.verification-team'));
        $this->assignUserRole($user21, config('role_names.roles.verification-team'));
        $this->assignUserRole($user22, config('role_names.roles.verification-team'));
        $this->assignUserRole($user23, config('role_names.roles.verification-team'));
        $this->assignUserRole($user24, config('role_names.roles.verification-team'));
        $this->assignUserRole($user25, config('role_names.roles.verification-team'));
        $this->assignUserRole($user26, config('role_names.roles.verification-team'));
        $this->assignUserRole($user27, config('role_names.roles.verification-team'));
        $this->assignUserRole($user28, config('role_names.roles.verification-team'));
        $this->assignUserRole($user29, config('role_names.roles.verification-team'));
        $this->assignUserRole($user30, config('role_names.roles.verification-team'));
    }

    /**
     * @return void
     */
    private function createInChargeTeamUser(): void
    {
        $user = User::factory()->verified()->create([
            'email' => 'adminIncharge@uhs.com',
            'password' => Hash::make('fE974daqEP'),
        ]);

        $user1 = User::factory()->verified()->create([
            'email' => 'iv1@uhs.com',
            'name' => 'iv1@uhs.com',
            'password' => Hash::make('qpEy3S968p'),
        ]);

        $user2 = User::factory()->verified()->create([
            'email' => 'iv2@uhs.com',
            'name' => 'iv2@uhs.com',
            'password' => Hash::make('n98CDd9Dwv'),
        ]);

        $user3 = User::factory()->verified()->create([
            'email' => 'iv3@uhs.com',
            'name' => 'iv3@uhs.com',
            'password' => Hash::make('Ur94GJ59tz'),
        ]);

        $user4 = User::factory()->verified()->create([
            'email' => 'iv4@uhs.com',
            'name' => 'iv4@uhs.com',
            'password' => Hash::make('tz8BCsJ85e'),
        ]);

        $this->assignUserRole($user, config('role_names.roles.incharge-team'));
        $this->assignUserRole($user1, config('role_names.roles.incharge-team'));
        $this->assignUserRole($user2, config('role_names.roles.incharge-team'));
        $this->assignUserRole($user3, config('role_names.roles.incharge-team'));
        $this->assignUserRole($user4, config('role_names.roles.incharge-team'));
    }

    /**
     * @return void
     */
    private function createSupervisoryTeamUser(): void
    {
        $user = User::factory()->verified()->create([
            'email' => 'adminsupervisory@uhs.com',
            'password' => Hash::make('5kagp59jV5'),
        ]);

        $user1 = User::factory()->verified()->create([
            'email' => 'st1@uhs.com',
            'name' => 'st1@uhs.com',
            'password' => Hash::make('399B985Utn'),
        ]);

        $user2 = User::factory()->verified()->create([
            'email' => 'st2@uhs.com',
            'name' => 'st2@uhs.com',
            'password' => Hash::make('5fHKUf6e84'),
        ]);

        $user3 = User::factory()->verified()->create([
            'email' => 'st3@uhs.com',
            'name' => 'st3@uhs.com',
            'password' => Hash::make('EyV839vm2j'),
        ]);

        $user4 = User::factory()->verified()->create([
            'email' => 'st4@uhs.com',
            'name' => 'st4@uhs.com',
            'password' => Hash::make('nx79X949Tc'),
        ]);

        $user5 = User::factory()->verified()->create([
            'email' => 'st5@uhs.com',
            'name' => 'st5@uhs.com',
            'password' => Hash::make('9ftTMz5ZM6'),
        ]);

        $user6 = User::factory()->verified()->create([
            'email' => 'st6@uhs.com',
            'name' => 'st6@uhs.com',
            'password' => Hash::make('7zSnG69Y4r'),
        ]);

        $user7 = User::factory()->verified()->create([
            'email' => 'st7@uhs.com',
            'name' => 'st7@uhs.com',
            'password' => Hash::make('YWuB8bGv98'),
        ]);

        $user8 = User::factory()->verified()->create([
            'email' => 'st8@uhs.com',
            'name' => 'st8@uhs.com',
            'password' => Hash::make('hdFw8x8s3b'),
        ]);



        $this->assignUserRole($user, config('role_names.roles.supervisory-team'));
        $this->assignUserRole($user1, config('role_names.roles.supervisory-team'));
        $this->assignUserRole($user2, config('role_names.roles.supervisory-team'));
        $this->assignUserRole($user3, config('role_names.roles.supervisory-team'));
        $this->assignUserRole($user4, config('role_names.roles.supervisory-team'));
        $this->assignUserRole($user5, config('role_names.roles.supervisory-team'));
        $this->assignUserRole($user6, config('role_names.roles.supervisory-team'));
        $this->assignUserRole($user7, config('role_names.roles.supervisory-team'));
        $this->assignUserRole($user8, config('role_names.roles.supervisory-team'));
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
