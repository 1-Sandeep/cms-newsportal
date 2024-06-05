<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            ['title' => 'Laravel', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'PHP', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'JavaScript', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'HTML', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'CSS', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Vue.js', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'React', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Node.js', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'MySQL', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'PostgreSQL', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Docker', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Kubernetes', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
