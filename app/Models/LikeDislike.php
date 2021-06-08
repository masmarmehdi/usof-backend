<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeDislike extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comment_id',
        'type'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'post_id' => 'integer',
        'comment_id' => 'integer',
        'type' => 'string'
    ];
}
