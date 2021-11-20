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

    public function index(){
        $post  = Post::latest()->simplePaginate(10);
        if($post){
            return Post::all();
        };
        return response()->json(['message' => 'No posts yet, create a post and be the first one!'], 404);
    }
    public function authType($request){
        if(Auth::id()){
            return Auth::id();
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
            return response()->json(['error' => $validator->errors()]);
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
                'title' => $request->input('title'),
                'categories' => $request->input('categories'),
                'content' => $request->input('content'),
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

    public function destroy($id): JsonResponse
    {
        $post = Post::find($id);
        if($post){
            $post->delete();
            return response()->json(['message' => 'Post deleted successfully!']);
        }
        return response()->json(['error' => 'Post does not exist!']);

    }

}
