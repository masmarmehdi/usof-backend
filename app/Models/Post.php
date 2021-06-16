<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'content',
        'user_id',
        'categories',
        'likes',
        'dislikes'
    ];

    public function likeDislikes(){
        return $this->hasMany(LikeDislike::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
