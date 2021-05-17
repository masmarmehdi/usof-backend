<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{

    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => rand(1,10),
            'title' => $this->faker->title(),
            'content' => $this->faker->text(),
            'categories' => $this->faker->title(),
        ];
    }
}
