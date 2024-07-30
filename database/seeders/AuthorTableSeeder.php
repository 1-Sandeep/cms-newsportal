<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->insert(
            [
                [
                    'name' => 'SP Blog Writer',
                    'description' => null,
                    'is_active' => 1,
                    'image' => null,
                    'trash' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'Sandeep Poudel',
                    'description' => 'Sandeep Poudel is a chief writer in SP Blog',
                    'is_active' => 1,
                    'image' => null,
                    'trash' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            ]
        );
    }
}
