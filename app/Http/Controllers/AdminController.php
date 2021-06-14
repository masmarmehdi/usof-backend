<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class AdminController extends Controller
{
    public function home(){
        return view('admin/home');
    }
    public function showPosts(){
        $posts = Post::all();
        return view('admin/post/show',compact('posts'));
    }
    public function showUsers(){
        $users = User::all();
        return view('admin/user/show',compact('users'));
    }

    public function showCategories(){
        $categories = Category::all();
        return view('admin/category/show',compact('categories'));
    }

    public function createPost(){
        return view('admin/post/post');
    }

    public function storePosts(Request $request){
        return Post::create($request->all());
    }
}
