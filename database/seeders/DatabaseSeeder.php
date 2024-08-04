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
            PostTableSeeder::class,
            UserTableSeeder::class,
            AuthorTableSeeder::class,
            CategoryTableSeeder::class,
            TagTableSeeder::class,
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            PageTableSeeder::class,
        ]);
    }
}
