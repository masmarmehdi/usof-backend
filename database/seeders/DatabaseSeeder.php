<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        \App\Models\User::factory(100)->create();
        \App\Models\Post::factory(100)->create();
        \App\Models\Category::factory(100)->create();
        // \App\Models\LikeDislike::factory(100)->create();/
        // \App\Models\Comment::factory(100)->create();


    }
}
