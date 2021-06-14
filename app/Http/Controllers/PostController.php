<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Post;
use Illuminate\Support\Facades\Auth;
use Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user(Auth::getToken());;
    }
    public function index(){
        $post  = Post::all();
        if($post){
            return Post::all();
        };
        return response()->json(['message' => 'No posts yet, create a post and be the first one!'], 404);
    }
    
    public function store(Request $request){
        $postReq = [
            'user_id' => $this->user->id,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'categories' => $request->input('categories')
        ];
        $validator = Validator::make($postReq,[
            'title' => 'required',
            'content' => 'required',
            // 'categories' => 'required'
        ]);
        
        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        $post = Post::create($postReq);
        return response()->json([
            'post' => $post
        ], 201);
    }


    public function show($id)
    {
        $post = Post::find($id);
        if($post){
            return response()->json($post, 200);
        };
        return response()->json(['message' => 'post not found'], 404);
    }

    public function update(Request $request, $id){
        $post = Post::find($id);
        if($post){
            $post->update($request->all());
            return response()->json([
                'message' => 'post  updated successfully!',
                'post' => $post
            ], 200);
        };
        return response()->json(['message' => 'post not found'], 404);
    }

    public function destroy($id, Request $request){
        $post = Post::find($id);
        $post->delete();
        return response()->json(null, 204);
    }

    public function showPosts($category_id)
    {
        $category = Category::find($category_id);
        if ($category)
            return Posts::whereJsonContains('category_id', (int)$category_id)->get();
            
        return response([
            'message' => 'Invalid category!'
        ], 404);
    }


    protected function guard(){
        return Auth::guard();
    }
}
