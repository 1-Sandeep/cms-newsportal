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
        // factory
        User::factory()->count(23)->create();

        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@spblog.com',
                'password' => Hash::make('Admin5635@5P6l0G#'),
            ],

            [
                'name' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'password' => Hash::make('John@123456'),
            ],
        ];

        foreach ($users as $user) {

            User::create($user);
        }
    }
}
