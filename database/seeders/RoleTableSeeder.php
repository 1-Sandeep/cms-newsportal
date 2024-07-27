<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Super Admin role
        $super_admin = \App\Models\Role::firstOrCreate(
            ['slug' => 'super-admin'],
            ['name' => 'Super Admin']
        );

        // Create Super Admin user
        $user = \App\Models\User::firstOrCreate(
            ['email' => 'superadmin@spblog.com'],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@spblog.com',
                'password' => Hash::make('Admin5635@5P6l0G#') // Use a secure password
            ]
        );

        // Attach all permissions to Super Admin role
        $permissions = \App\Models\Permission::pluck('id')->toArray();
        $super_admin->permissions()->syncWithoutDetaching($permissions);

        // Attach Super Admin role to the user
        $user->roles()->syncWithoutDetaching([$super_admin->id]);
    }
}
