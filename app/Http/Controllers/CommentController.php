<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\LikeDislike;



class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user(Auth::getToken());
    }

    public function index()
    {
        $comment = Comment::all();
        if(!$comment){
            return response()->json(['message' => 'Comment  does not exist'], 200);
        }
        return Comment::all();
    }

    public function show($id)
    {
        $comment = Comment::find($id);
        if ($comment)
            return Comment::find($id);

        return response([
            'message' => 'Invalid comment'
        ], 404);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $user = User::find($comment->user_id);
        if (!$comment){
            return response([
                'message' => 'Comment does not exist'
            ], 404);
        }
        if ($comment->user_id != $this->user->id){
            return response([
                'message' => 'Access denied! You can not change this comment!',
                'Commented by' => $user->username
            ], 403);
        }
        $comment->update($request->only(['content']));
        return response()->json([
            'message' => 'Comment added successfully', 
            'Comment' => $comment
        ], 200, $headers);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if($comment->user_id != $this->user->id){
            return response()->json([
                'message' => "Access denied! Cannot delete someone's comment"
            ], 403);
        }
        if ($comment)
            Comment::destroy($id);
            return response()->json([
                'message' => 'comment deleted succcessfully'
            ], 200);
        return response([
            'message' => 'Invalid comment'
        ], 404);
    }

    public function showComments($post_id)
    {
        $post = Post::find($post_id);
        if (!$post)
            return response()->json([
                'message' => 'This Comment does not exist!'
            ], 404);
        $comment = Comment::where('post_id', $post_id)->get()->toArray();
        if (!$comment)
            return response([
                'message' => 'Invalid Comment or no comments'
            ], 404);

        return response()->json($comment, 200);
    }

    public function createComment(Request $request, $post_id)
    {
        $post = Post::find($post_id);
        if (!$post)
            return response()->json([
                'message' => 'This Comment does not exist!'
            ], 404);

        $comment = Comment::create([
            'user_id' => $this->user->id,
            'post_id' => $post_id,
            'content' => $request->input('content')
        ]);
        return response()->json($comment, 201);;
    }

    public function createCommentLike(Request $request, $comment_id){
        $comment = Comment::find($comment_id);
        if (!$comment)
            return response()->json([
                'message' => 'This comment does not exist!'
            ], 404);

        $likeDup = LikeDislike::where('user_id', $this->user->id)->where('comment_id', $comment_id)->first();
        
        $data = [
            'user_id' => $this->user->id,
            'comment_id' => $comment_id,
            'type' => $request->input('type')
        ];

        if ($request->input('type') == 'like'){

            if ($likeDup) {
                // $this->deleteCommentLike($request, $comment_id);
                $data = LikeDislike::where('comment_id', $comment_id)->where('user_id', $this->user->id)->where('type', 'like')->first();
                $current = Comment::where('id', $comment_id)->first()->likes;
                $new = $current - 1;
                Comment::where('id', $comment_id)->update(array('likes' => $new));

                $data->delete();
                return response([
                    'message' => 'Like deleted successfully'
                ]);
            }

            $current = Comment::where('id', $comment_id)->first()->likes;
            $new = $current + 1;
            Comment::where('id', $comment_id)->update(array('likes' => $new));

            return response([
                'message' => 'Like created successfully',
                'data' => LikeDislike::create($data)
            ]);
        }
        else if($request->input('type') == 'dislike'){

            if ($likeDup) {
                // $this->deleteCommentLike($request, $comment_id);
                $data = LikeDislike::where('comment_id', $comment_id)->where('user_id', $this->user->id)->where('type', 'dislike')->first();
                $current = (int)Comment::where('id', $comment_id)->first()->dislikes;
                $new = $current - 1;
                Comment::where('id', $comment_id)->update(array('dislikes' => $new));

                $data->delete();
                return response([
                    'message' => 'Like deleted successfully'
                ]);
            }

            $current = Comment::where('id', $comment_id)->first()->dislikes;
            $new = $current + 1;
            Comment::where('id', $comment_id)->update(array('dislikes' => $new));

            return response([
                'message' => 'Dislike  created successfully',
                'Disliked by' => $this->user->username,
                'data' => LikeDislike::create($data)
            ]);
        }
        
    }


    // public function deleteCommentLike(Request $request, $comment_id){

    //     $likeType = LikeDislike::where('comment_id', $comment_id)->first()->type;

    //     $comment = Comment::find($comment_id);
    //     if (!$comment)
    //         return response()->json([
    //             'message' => 'This Comment does not exist!'
    //         ], 404);
    //     if ($likeType == 'like'){
    //         $data = LikeDislike::where('comment_id', $comment_id)->where('user_id', $this->user->id)->where('type', 'like')->first();
    //         $current = Comment::where('id', $comment_id)->first()->likes;
    //         $new = $current - 1;
    //         Comment::where('id', $comment_id)->update(array('dislikes' => $new));

    //         $data->delete();
    //         return response([
    //             'message' => 'Like successfuly deleted'
    //         ]);
    //     }
    //     else if ($likeType == 'dislike'){
    //         $data = LikeDislike::where('comment_id', $comment_id)->where('user_id', $this->user->id)->where('type', 'dislike')->first();
    //         $current = Comment::where('id', $comment_id)->first()->dislikes;
    //         $new = $current - 1;
    //         Comment::where('id', $comment_id)->update(array('likes' => $new));

    //         $data->delete();
    //         return response([
    //             'message' => 'Dislike successfuly deleted'
    //         ]);
    //     }
    //     return response()->json(['message' => 'invalid']);
    // }
}
