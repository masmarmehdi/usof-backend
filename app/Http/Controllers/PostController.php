<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Post;

class PostController extends Controller
{
    public function showPosts(){
        $post  = Post::all();
        if($post){
            return Post::all();
        }
        return response()->json(['message' => 'No posts yet'], 404);
    }
    
    public function createPost(Request $request){
        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    public function showPost($id)
    {
        $post = Post::find($id);
        if($post){
            return response()->json($post, 200);
        }
        return response()->json(['message' => 'post not found'], 404);
    }

    public function updatePost($id, Request $request){
        $post = Post::find($id);
        if($post){
            $post->update($request->all());
            return response()->json($post, 200);
        }
        return response()->json(['message' => 'post not found'], 404);
    }

    public function deletePost($id, Request $request){
        $post = Post::find($id);
        $post->delete();
        return response()->json(null, 204);
    }
    public function createLike($id){
        Post::update('update post set likes = 1 where id = ?', $id);
    }
    public function getLikes($id){
        $post = Post::where('id', $id)->value('likes');
        return response()->json("Number of likes in this post is: ".$post, 200);
    }
    public function getDislikes($id){
        $post = Post::where('id', $id)->value('dislikes');
        return response()->json("Number of dislikes in this post is: ".$post, 200);
    }

    public function getComments(){
        
    }
    public function createComment(){

    }
}
