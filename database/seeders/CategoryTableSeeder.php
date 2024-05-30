<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                [
                    'id' => 1,
                    'title' => 'National',
                    'slug' => 'national',
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],

                [
                    'id' => 2,
                    'title' => 'Society',
                    'slug' => 'society',
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],

                [
                    'id' => 3,
                    'title' => 'Technology',
                    'slug' => 'technology',
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],

                [
                    'id' => 4,
                    'title' => 'International',
                    'slug' => 'international',
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],

                [
                    'id' => 5,
                    'title' => 'Cover Story',
                    'slug' => 'cover-story',
                    'is_active' => 0,
                    'created_at' => Carbon::now(),
                ],

                [
                    'id' => 6,
                    'title' => 'Sports',
                    'slug' => 'sports',
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],

                [
                    'id' => 7,
                    'title' => 'Business',
                    'slug' => 'business',
                    'is_active' => 0,
                    'created_at' => Carbon::now(),
                ],

                [
                    'id' => 8,
                    'title' => 'Politics',
                    'slug' => 'politics',
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],

                [
                    'id' => 9,
                    'title' => 'Entertainment',
                    'slug' => 'entertainment',
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],

                [
                    'id' => 10,
                    'title' => 'Economy',
                    'slug' => 'economy',
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],

                [
                    'id' => 11,
                    'title' => 'Art and Culture',
                    'slug' => 'art-and-culture',
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                ],
            ]
        );
    }
}
