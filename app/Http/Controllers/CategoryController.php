<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Category;
use App\models\Post;


class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

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
    public function store(Request $request){
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }
    
    public function show($id)
    {
        $category = Category::find($id);
        if($category){
            return response()->json($category, 200);
        }
        return response()->json(['message' => 'Category not found'], 404);
    }

    public function update($id, Request $request){
        $category = Category::find($id);
        if($category){
            $category->update($request->all());
            return response()->json($category, 200);
        }
        return response()->json(['message' => 'Category not found'], 404);
    }

    public function destroy($id, Request $request){
        $category = Category::find($id);
        $category->delete();
        return response()->json(null, 204);
    }
}
