<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\LikeDislike;
use App\Models\User;
use App\Models\Post;


class LikeDislikeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->user = JWTAuth::user(JWTAuth::getToken());
    }

    public function getLikes($id){
        $likes = Post::where('id', $id)->value('likes');
        $post = Post::find($id);
        $user = User::find($post->user_id);
        return response()->json("Number of likes in " . $user->username. "'s post is: ".$likes, 200);
    }
    public function getDislikes($id){
        $dislikes = Post::where('id', $id)->value('dislikes');
        $post = Post::find($id);
        $user = User::find($post->user_id);
        return response()->json("Number of dislikes in " . $user->username. "'s post is: ".$dislikes, 200);
    }

    public function index(){
        return LikeDislike::all();
    }

    public function createPostLike(Request $request, $post_id){
        $post = Post::find($post_id);
        if (!$post)
            return response()->json([
                'message' => 'This post does not exist!'
            ], 404);

        $likeisDup = LikeDislike::where('user_id', $this->user->id)->where('post_id', $post_id)->first();
        $dislikeisDup = LikeDislike::where('user_id', $this->user->id)->where('post_id', $post_id)->first();

            // return response()->json($likeisDup, 200);
        

        $data = [
            'user_id' =>$this->user->id,
            'post_id' => $post_id,
            'type' => $request->input('type')
        ];


            
            if ($request->input('type') == 'like'){

                if ($likeisDup != null) {
                    return $this->deletePostLike($request, $post_id);
                    // return response()->json(['message' =>  'Like deleted successfully'], 200);
                }

                $current = (int)Post::where('id', $post_id)->first()->likes;
                $new = $current + 1;
                Post::where('id', $post_id)->update(array('likes' => $new));

                $user_id = Post::where('id', $post_id)->first()->user_id;
                $currentUserRating = (int)User::where('id', $user_id)->first()->rating;
                $UpdatedUserRating = $currentUserRating + 1;
                User::where('id', $user_id)->update(array('rating' => $UpdatedUserRating));
            }
            else if($request->input('type') == 'dislike'){

                if ($dislikeisDup != null) {
                    $this->deletePostLike($request, $post_id);
                    return response()->json(['message' =>  'Dislike deleted successfully'], 200);
                }

                $current = Post::where('id', $post_id)->first()->dislikes;
                $new = $current + 1;
                Post::where('id', $post_id)->update(array('dislikes' => $new));

                $user_id = Post::where('id', $post_id)->first()->user_id;
                $currentUserRating = (int)User::where('id', $user_id)->first()->rating;
                $UpdatedUserRating = $currentUserRating - 1;
                User::where('id', $user_id)->update(array('rating' => $UpdatedUserRating));
            }
            
            
            
            return response([
                'message' => $request->input('type') . ' created',
                'Liked by' => $this->user->username,
                'data' => LikeDislike::create($data)
            ]);

        
    }

   

    public function deletePostLike(Request $request, $post_id){

        $like = LikeDislike::where('post_id', $post_id)->first();

        $dislike = LikeDislike::where('post_id', $post_id)->first();

        $post = Post::find($post_id);
        if (!$post)
            return response()->json([
                'message' => 'This post does not exist!'
            ], 404);
        if ($like == 'like'){
            $data = LikeDislike::where('post_id', $post_id)->where('user_id', $this->user->id)->where('type', 'like')->first();
            $current = Post::where('id', $post_id)->first()->likes;
            $new = $current - 1;
            $user_id = Post::where('id', $post_id)->first()->user_id;
            Post::where('id', $post_id)->update(array('likes' => $new));
            $currentUserRating = (int)User::where('id', $user_id)->first()->rating;
            $UpdatedUserRating = $currentUserRating - 1;
            User::where('id', $user_id)->update(array('rating' => $UpdatedUserRating));
            return $data;

            $data->delete();
            return response([
                'message' => $request->input('type') . ' successfully deleted'
            ]);
        }
        else if ($dislike == 'dislike'){

            $data = LikeDislike::where('post_id', $post_id)->where('user_id', $this->user->id)->where('type', $request->input('type'))->first();

            $current = Post::where('id', $post_id)->first()->dislikes;
            $new = $current - 1;
            Post::where('id', $post_id)->update(array('dislikes' => $new));
            $user_id = Post::where('id', $post_id)->first()->user_id;
    
            $currentUserRating = (int)User::where('id', $user_id)->first()->rating;
            $UpdatedUserRating = $currentUserRating + 1;
            User::where('id', $user_id)->update(array('rating' => $UpdatedUserRating));
            return $data;
            // $data->delete();
            // return response([
            //     'message' => $request->input('type') . ' successfuly deleted'
            // ]);
        }

        
    }
}
