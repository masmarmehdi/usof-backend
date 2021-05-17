<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // protected $user;
    // public function __construct(){
    //     $this->middleware('auth:api');
    //     $this->user = $this->guard()->user();
    // }
    public function showPosts(){
        $post  = Post::all();
        if($post){
            return Post::all();
        };
        return response()->json(['message' => 'No posts yet, create a post and be the fisrt one!'], 404);
    }
    
    public function createPost(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'content' => 'required',
            'category' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 400, $headers);
        }
        $post = Post::create($request->all());
        return response()->json([
            'status' => true,
            'post' => $post
        ], 201);
    }

    public function showPost($id)
    {
        $post = Post::find($id);
        if($post){
            return response()->json($post, 200);
        };
        return response()->json(['message' => 'post not found'], 404);
    }

    public function updatePost($id, Request $request){
        $post = Post::find($id);
        if($post){
            $post->update($request->all());
            return response()->json($post, 200);
        };
        return response()->json(['message' => 'post not found'], 404);
    }

    public function deletePost($id, Request $request){
        $post = Post::find($id);
        $post->delete();
        return response()->json(null, 204);
    }
    public function createLike($id, Request $request){
        $post = Post::find($id);
        // $likes = $request->likes;
        // if($likes){
        //     $post->update('')
        // }

    }
    public function getLikes($id){
        $post = Post::where('id', $id)->value('likes');
        return response()->json("Number of likes in this post of id:".$id ." is: ".$post, 200);
    }
    public function getDislikes($id){
        $post = Post::where('id', $id)->value('dislikes');
        return response()->json("Number of dislikes in this post of id:".$id ." is: ".$post, 200);
    }
    
    protected function guard(){
        return Auth::guard();
    }
}
