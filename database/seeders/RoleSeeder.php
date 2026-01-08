<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('role_names.roles') as $roleName) {
            $role = Role::firstOrCreate([
                'name'       => $roleName,
                'guard_name' => 'web',
            ]);

            if ($roleName == 'Admin') {
                $role->givePermissionTo(config('role_names.permissions.admin'));
            }

            if ($roleName == 'Verification_Team') {
                $role->givePermissionTo(config('role_names.permissions.verification-team'));
            }

            if ($roleName == 'Supervisory_Team') {
                $role->givePermissionTo(config('role_names.permissions.supervisory-team'));
            }

            if ($roleName == 'Incharge_Team') {
                $role->givePermissionTo(config('role_names.permissions.incharge-team'));
            }
            
            if ($roleName == 'College') {
                $role->givePermissionTo(config('role_names.permissions.college'));
            }
        }
    }
}
