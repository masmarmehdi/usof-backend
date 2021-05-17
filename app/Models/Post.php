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
        'categories',
        'likes',
        'dislikes'
    ];

    // public function comments(): HasMany
    // {
    //     return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
    // }
}
