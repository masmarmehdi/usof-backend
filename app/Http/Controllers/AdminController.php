<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;


class AdminController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    //     $this->user = Auth::user(Auth::getToken());
    // }
    public function home(){
        return view('admin/home');
    }
    public function showPosts(){
        $posts = Post::all();
        return view('admin/post/show',compact('posts'));
    }

    public function showComments(){
        $comments = Comment::all();
        return view('admin/comments/show',compact('comments'));
    }

    public function showUsers(){
        $users = User::all();
        return view('admin/users/show',compact('users'));
    }

    public function showCategories(){
        $categories = Category::all();
        return view('admin/category/show',compact('categories'));
    }

    public function createPost(){
        return view('admin/post/create');
    }
    public function createComment(){
        return view('admin/comments/create');
   }
    public function createUser(){
        return view('admin/users/create');
    }
    public function storePosts(Request $request){
        return Post::create($request->all());
    }

    public function storeComments(Request $request){
        return Comment::create($request->all());
    }
    public function storeUser(Request $request){
        return User::create($request->all());
    }
}
