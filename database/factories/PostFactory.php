<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{

    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'title' => $this->faker->title(),
            'content' => $this->faker->text(),
            'images' => $this->faker->image($dir = public_path('posts_picture'), $width = 640, $height = 480, false, false),
            'categories' => Category::all()->random()->title,
        ];
    }
}
