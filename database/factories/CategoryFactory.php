<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{

    protected $model = Category::class;

    public function definition()
    {
        return [
            'post_id' => rand(1,100),
            'title' => $this->faker->title(),
        ];
    }
}
