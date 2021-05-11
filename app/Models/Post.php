<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'categories',
        'likes',
        'dislikes'
    ];
    // protected $casts = [
    //     'likes' => 'integer',
    //     'dislikes' => 'integer'
    // ];
}
