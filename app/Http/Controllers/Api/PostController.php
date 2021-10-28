<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\{
    JsonResponse,
    Request
};
use Illuminate\Support\Facades\{
    Auth,
    Validator
};
use App\Models\{
    Category,
    Post,
    User
};

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('create', 'update', 'destroy');
    }

    public function index(){
        $post  = Post::all();
        if($post){
            return Post::all();
        };
        return response()->json(['message' => 'No posts yet, create a post and be the first one!'], 404);
    }
    public function authType($request){
        if(Auth::id()){
            Auth::id();
        }
        return $request->input('user_id');
    }
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'content' => 'required',
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
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
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
        $post = Post::create([
            'user_id' =>  $this->authType($request),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'categories' => $request->input('categories'),
            'images'=>  implode("|",$images),
            'status' => $request->input('status')
        ]);
        return response()->json([
            'post' => $post
        ], 201);

    }


    public function show($id): JsonResponse
    {
        $post = Post::find($id);
        if($post){
            return response()->json($post, 200);
        };
        return response()->json(['message' => 'post not found'], 404);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:30',
            'content' => 'required|max:512',
            'categories' => 'required',
            'status' => 'required'
        ]);
        $post = Post::find($id);
        $user = User::find($post->user_id);

        if($post->user_id != Auth::id()){
            return response()->json([
                'message' => "Access denied ! Cannot edit someone's data",
                'post by' => $user->username
            ], 200);
        }
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()]);
        }
        if($post){
            $images = [];
            $files = $request->file('images');
            if($files){
                foreach($files as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('/posts_picture/'), $name);
                    array_push($images, $name);
                }
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
            $post->update([
                $request->all(),
                'images' => implode("|",$images),
                'status' => $request->input('status')
            ]);
            return response()->json([
                'message' => 'post  updated successfully!',
                'post' => $post
            ], 200);
        };
        return response()->json(['message' => 'post not found'], 404);
    }

    public function destroy($id, Request $request): JsonResponse
    {
        $post = Post::find($id);
        if($post){
            $post->delete();
            return response()->json(['message' => 'Post deleted successfully!'], 204);
        }
        return response()->json(['error' => 'Post does not exist!']);

    }

}
