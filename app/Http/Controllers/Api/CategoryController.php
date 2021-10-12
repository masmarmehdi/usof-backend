<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;

use App\models\{
    Category,
    Post
};
use Illuminate\{
    Http\Request,
    Http\JsonResponse,
    Http\RedirectResponse,
    Support\Facades\Validator
};

class CategoryController extends Controller
{

    public function index(){
        $category  = Category::all();
        if($category){
            return Category::all();
        }
        return response()->json(['message' => 'No Categories yet'], 404);
    }
    public function showCategories($post_id){
        $post = Post::find($post_id);
        return $post->categories;
    }
    public function store(Request $request): JsonResponse
    {
        $validation = Validator::make($request->input('title'), ['title' => 'required|string|max:30']);
        if($validation->fails()){
            return response()->json(['error' => $validation->errors()], 201);
        }
        $category = Category::create($validation->validated());
        return response()->json(['category' => $category], 201);
    }
    public function showPosts($category_id): JsonResponse
    {
        $category_title = Category::find($category_id)->title;
        $posts = Post::all();
        if($category_title){
            $getting_specific_categories = [];
            foreach($posts as $post){
                if(str_contains($post->categories, $category_title) !== false){
                    array_push($getting_specific_categories, $post);
                }
            }
            return response()->json($getting_specific_categories, 200);
        }
        return response()->json(['message' => 'Category does not exist'], 404);
    }
    public function show($id): JsonResponse
    {
        $category = Category::find($id);
        if($category){
            return response()->json($category, 200);
        }
        return response()->json(['message' => 'Category not found'], 404);
    }

    public function update($id, Request $request): RedirectResponse
    {
        $category = Category::find($id);
        if($category){
            $category->update($request->all());
            return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
        }
        return redirect()->route('categories.index')->with('fail', 'Category not found!');
    }

    public function destroy($category_id): JsonResponse
    {
        $category = Category::find($category_id);
        if($category){
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully'], 204);
        }
        return response()->json(['error' => 'Category not found to be deleted.'], 404);
    }
}
