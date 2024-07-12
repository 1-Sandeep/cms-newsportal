<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(
            [
                ['name' => 'Post Create', 'slug' => 'post-create'],
                ['name' => 'Post Read', 'slug' => 'post-read'],
                ['name' => 'Post Update', 'slug' => 'post-update'],
                ['name' => 'Post Delete', 'slug' => 'post-delete'],

                ['name' => 'Author Create', 'slug' => 'author-create'],
                ['name' => 'Author Read', 'slug' => 'author-read'],
                ['name' => 'Author Update', 'slug' => 'author-update'],
                ['name' => 'Author Delete', 'slug' => 'author-delete'],

                ['name' => 'Category Create', 'slug' => 'category-create'],
                ['name' => 'Category Read', 'slug' => 'category-read'],
                ['name' => 'Category Update', 'slug' => 'category-update'],
                ['name' => 'Category Delete', 'slug' => 'category-delete'],

                ['name' => 'User Create', 'slug' => 'user-create'],
                ['name' => 'User Read', 'slug' => 'user-read'],
                ['name' => 'User Update', 'slug' => 'user-update'],
                ['name' => 'User Delete', 'slug' => 'user-delete'],

                ['name' => 'Role Create', 'slug' => 'role-create'],
                ['name' => 'Role Read', 'slug' => 'role-read'],
                ['name' => 'Role Update', 'slug' => 'role-update'],
                ['name' => 'Role Delete', 'slug' => 'role-delete'],

                ['name' => 'Permission Read', 'slug' => 'permission-read'],

                ['name' => 'Page Create', 'slug' => 'page-create'],
                ['name' => 'Page Read', 'slug' => 'page-read'],
                ['name' => 'Page Update', 'slug' => 'page-update'],
                ['name' => 'Page Delete', 'slug' => 'page-delete'],

                // seo
                // ['name' => 'Seo Create and Update', 'slug' => 'seo-create-update'],
                // ['name' => 'Seo Read', 'slug' => 'seo-read'],
                // ['name' => 'Seo Delete', 'slug' => 'seo-delete'],
            ]
        );
    }
}
