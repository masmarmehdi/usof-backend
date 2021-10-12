<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\{
    Post,
    Comment,
    User
};
use Illuminate\{
    Http\RedirectResponse,
    Http\Request,
    Support\Facades\Auth,
    Support\Facades\Validator
};

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::all();
        return view('admin/comments/show',compact('comments'));
    }

    public function create(){
        return view('admin/comments/create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(),[
            'post_id' => 'required',
            'content' => 'required|max:512'
        ]);
        $post = Post::find($request->input('post_id'));
        $user_id = $post->user_id;
        $author = User::find($user_id)->username;
        if($validation->fails()){
            return redirect()->back()->with('fail', $validation->errors()->toJson());
        }
        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $request->input('post_id'),
            'content' => $request->input('content')
        ]);
        return redirect()->route('comment.index')->with('success', 'comment added successfully to ' . $author . '\'s post!');
    }

    public function edit($comment_id){
        $comment = Comment::find($comment_id)->first();
        return view('admin/comments/edit', compact('comment'));
    }



    public function update($comment_id, Request $request){
        $comment = Comment::find($comment_id)->first();
        if($comment){
            Comment::where('id', $comment_id)->update([
                'content' => $request->input('content'),
            ]);
            return redirect()->route('comment.index')->with('success', 'Comment updated successfully');
        }

    }

    public function destroy($comment_id): RedirectResponse
    {
        $comment = Comment::find($comment_id);
        if($comment){
            $comment->delete();
            return redirect()->route('comment.index')->with('success', 'Comment deleted successfully');
        }
        return redirect()->route('comment.index')->with('fail', 'Comment does not exist to be deleted!');

    }
}
