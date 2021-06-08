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
        'category_id',
        'likes',
        'dislikes'
    ];

    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function disLikes(){
        return $this->hasMany(Dislike::class);
    }
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
}
