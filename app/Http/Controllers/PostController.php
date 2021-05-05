<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return view('post');
    }
    public function createPost(){
        $input = request()->all();
        Post::create($input);
    }
    public function showPosts(){
        return DB::select('select * from posts');
    }
}
