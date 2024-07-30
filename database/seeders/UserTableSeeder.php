<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@spblog.com',
                'password' => Hash::make('Admin5635@5P6l0G#'),
                'is_active' => 1,
                'trash' => 0,
            ],

            [
                'name' => 'John Doe',
                'email' => 'sandeeppoudel00@gmail.com',
                'password' => Hash::make('SandeepAryan@5635#.'),
                'is_active' => 1,
                'trash' => 0,
            ],
        ];

        foreach ($users as $user) {

            User::create($user);
        }
    }
}
