<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{

    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'post_id' => Post::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'content' => $this->faker->text(),
        ];
    }
}
