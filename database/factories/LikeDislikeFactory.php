<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\LikeDislike;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LikeDislikeFactory extends Factory
{

    protected $model = LikeDislike::class;

    public function definition()
    {
        $type = ['like', 'dislike'];
        $random_type_of_likes = array_rand($type);
        return [
            'post_id' => Post::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'type' => $type[$random_type_of_likes]
        ];
    }
}
