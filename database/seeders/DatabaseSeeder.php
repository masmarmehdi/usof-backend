<?php

namespace Database\Seeders;

use App\Models\{
    Category,
    Comment,
    Post,
    User,
    LikeDislike
};
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
        User::factory(100)->create();
        Category::factory(100)->create();
        Post::factory(100)->create();
        Comment::factory(100)->create();
        LikeDislike::factory(100)->create();
    }
}
