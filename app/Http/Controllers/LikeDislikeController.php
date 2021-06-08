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
        return response()->json("Number of likes in this post of id:".$id ." is: ".$likes, 200);
    }
    public function getDislikes($id){
        $dislikes = Post::where('id', $id)->value('dislikes');
        return response()->json("Number of dislikes in this post of id:".$id ." is: ".$dislikes, 200);
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

        $likeDup = LikeDislike::where('user_id', $this->user->id)->where('post_id', $post_id)->first();
        if ($likeDup) {
            $this->deletePostLike($request, $post_id);
            return response([
                'message' => $request->input('type') . ' deleted'
            ]);
        }

        $data = [
            'user_id' => $this->user->id,
            'post_id' => $post_id,
            'type' => $request->input('type')
        ];

        if ($request->input('type') == 'like'){
            $current = Post::where('id', $post_id)->first()->rating;
            $new = $current + 1;
            Post::where('id', $post_id)->update(array('likes' => $new));

            $user_id = Post::where('id', $post_id)->first()->user_id;

            $currentUserRating = (int)User::where('id', $user_id)->first()->rating;
            $UpdatedUserRating = $currentUserRating + 1;
            User::where('id', $user_id)->update(array('rating' => $UpdatedUserRating));
        }
        $current = Post::where('id', $post_id)->first()->rating;
        $new = $current - 1;
        Post::where('id', $post_id)->update(array('dislikes' => $new));

        $user_id = Post::where('id', $post_id)->first()->user_id;

        $currentUserRating = (int)User::where('id', $user_id)->first()->rating;
        $UpdatedUserRating = $currentUserRating - 1;
        User::where('id', $user_id)->update(array('rating' => $UpdatedUserRating));

        return response([
            'message' => $request->input('type') . ' created',
            'data' => LikeDislike::create($data)
        ]);
    }

   

    public function deletePostLike(Request $request, $post_id){
        $data = LikeDislike::where('post_id', $post_id)->where('user_id', $this->user->id)->where('type', $request->input('type'))->first();
        $likeType = LikeDislike::where('post_id', $post_id)->first()->type;

        $post = Post::find($post_id);
        if (!$post)
            return response()->json([
                'message' => 'This post does not exist!'
            ], 404);
            
        if (!$data)
            return response()->json([
                'message' => 'Nothing to remove!'
            ], 404);

        if ($likeType == 'like'){
            $current = Post::where('id', $post_id)->first()->rating;
            $new = $current - 1;
            Post::where('id', $post_id)->update(array('dislikes' => $new));

            $user_id = Post::where('id', $post_id)->first()->user_id;

            $currentUserRating = (int)User::where('id', $user_id)->first()->rating;
            $UpdatedUserRating = $currentUserRating - 1;
            User::where('id', $user_id)->update(array('rating' => $UpdatedUserRating));
        }
        else if ($likeType == 'dislike'){
            $current = Post::where('id', $post_id)->first()->rating;
            $new = $current + 1;
            Post::where('id', $post_id)->update(array('likes' => $new));
    
            $user_id = Post::where('id', $post_id)->first()->user_id;
    
            $currentUserRating = (int)User::where('id', $user_id)->first()->rating;
            $UpdatedUserRating = $currentUserRating + 1;
            User::where('id', $user_id)->update(array('rating' => $UpdatedUserRating));
        }

        $data->delete();
        return response([
            'message' => $request->input('type') . ' successfuly deleted'
        ]);
    }
}
