<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Category,
    Comment,
    Post,
    User
};
use Illuminate\{
    Http\RedirectResponse,
    Http\Request,
    Support\Facades\Auth,
    Support\Facades\DB,
    Support\Facades\Validator
};

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        $comments = [];
        foreach ($posts as $post){
            $comment = Comment::where('post_id', $post->id)->count();
            array_push($comments, $comment);
        }
        return view('admin/post/show', compact('posts', 'comments'));
    }

    public function create(){
        $categories = Category::all();
        return view('admin/post/create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:30',
            'content' => 'required|max:512',
            'categories' => 'required',
            'status' => 'required'
        ]);
        $images = [];
        $files = $request->file('images');
        if($files){
            foreach($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('/posts_picture/'), $name);
                array_push($images, $name);
            }
        }

        if($validator->fails()){
            return redirect()->route('post.index')->with('fail', json_decode($validator->errors()->toJson()));
        }
        $categories = explode(", ", $request->input('categories'));
        foreach($categories as $category){
            $category_exists = Category::where('title', $category)->first();
            if(!$category_exists){
                Category::create([
                    'title' => trim($category),
                ]);
            }
        }
        Post::create([
            'images'=>  implode("|",$images),
            'user_id' =>  Auth::id(),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'categories' => $request->input('categories'),
            'status' => $request->input('status')
        ]);
        return redirect()->route('post.index')->with('success', 'Post created successfully!');
    }

    public function edit($post_id){
        $post = Post::find($post_id)->first();
        return view('admin/post/edit', compact('post'));
    }

    public function update($id, Request $request){
        $post = Post::find($id);
        if($post->user_id != Auth::id()){
            return redirect()->route('post.index')->with('fail', 'Access denied ! Cannot edit someone\'s data');
        }
        if($post){
            $post->update($request->all());
            return redirect()->route('post.index')->with('success', 'Post updated successfully!');
        }
        return redirect()->route('post.index')->with('fail', 'Post does not even exist!');
    }

    public function postStatus($id): RedirectResponse
    {
        $post = DB::table('posts')->where('id', $id)->first();
        $author = User::find($post->user_id);
        if($post){
            if($post->status == 'active'){
                DB::table('posts')->where('id', $id)->update(['status' => 'inactive']);

                return redirect()->route('post.index')->with('success', 'Now '. $author->name . '\'s post is inactive!');
            }
            DB::table('posts')->where('id', $id)->update(['status' => 'active']);
            return redirect()->route('post.index')->with('success', 'Now '. $author->name . '\'s post is active!');
        }
        return redirect()->back()->with('fail', 'Post id does not exist!');
    }

    public function delete($id): RedirectResponse
    {
        $post  = Post::find($id);
        if($post){
            $post->delete();
            return redirect()->route('post.index')->with('success', 'Post deleted successfully!');
        }
        return redirect()->route('post.index')->with('fail', 'Post already deleted or does not exist in the first place!');
    }

    public function postDetail($post_id){
        $post = Post::find($post_id);
        $user_id = $post->user_id;
        $user = User::find($user_id);
        $categories = $post->categories;
        $categories = explode(" ", $categories);
        $comments = Comment::where('post_id', $post_id)->count();
        return view('admin.post.detail', compact('post', 'user', 'categories', 'comments'));
    }
}
