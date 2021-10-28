<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\{
    Http\Request,
    Http\JsonResponse,
    Support\Facades\Auth
};
use App\Models\{
    Comment,
    Post,
    User
};

class CommentController extends Controller
{


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
    public function edit($id){
        $comment = Comment::find($id);
        return view('admin.comments.edit', compact('comment'));
    }
    public function authType($request){
        if(Auth::id()){
            Auth::id();
        }
        return $request->input('user_id');
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
        if ($comment->user_id != $this->authType($request)){
            return response([
                'message' => 'Access denied! You can not change this comment!',
                'Commented by' => $user->username
            ], 403);
        }
        $comment->update([
            'content' => $request->input('content')]);
        return response()->json([
            'message' => 'Comment added successfully',
            'Comment' => $comment
        ], 200);
    }

    public function destroy($id, Request $request)
    {
        $comment = Comment::find($id);
        if($comment->user_id != $this->authType($request)){
            return response()->json([
                'message' => "Access denied! Cannot delete someone's comment"
            ], 403);
        }
        if ($comment) {
            Comment::destroy($id);
            return response()->json([
                'message' => 'comment deleted succcessfully'
            ], 200);
        }
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

    public function createComment(Request $request, $post_id): JsonResponse
    {
        $post = Post::find($post_id);
        if (!$post)
            return response()->json([
                'message' => 'This Comment does not exist!'
            ], 404);

        $comment = Comment::create([
            'user_id' => $this->authType($request),
            'post_id' => $post_id,
            'content' => $request->input('content')
        ]);
        return response()->json($comment, 201);
    }

}
