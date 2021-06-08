<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user(Auth::getToken());
    }

    public function index()
    {
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
        if (!$data = Comment::find($id))
            return response([
                'message' => 'Invalid comment'
            ], 404);

        if ($data->user_id != $this->user->id)
            return response([
                'message' => 'You can not change this comment!'
            ], 403);
        $data->update($request->only(['content']));
        return $data;
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if ($comment)
            return Comment::destroy($id);
            
        return response([
            'message' => 'Invalid comment'
        ], 404);
    }

    public function showComments($post_id)
    {
        $post = Post::find($post_id);
        if (!$post)
            return response()->json([
                'message' => 'This post does not exist!'
            ], 404);
        $comment = Comment::where('post_id', $post_id)->get()->toArray();
        if (!$comment)
            return response([
                'message' => 'Invalid post or no comments'
            ], 404);

        return response()->json($comment, 200);
    }

    public function createComment(Request $request, $post_id)
    {
        $post = Post::find($post_id);
        if (!$post)
            return response()->json([
                'message' => 'This post does not exist!'
            ], 404);

        $comment = Comment::create([
            'user_id' => $this->user->id,
            'post_id' => $post_id,
            'content' => $request->input('content')
        ]);

        return response()->json($comment, 201);;
    }
}
