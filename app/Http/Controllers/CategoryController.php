<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Category;


class CategoryController extends Controller
{
    public function showCategories(){
        $category  = Category::all();
        if($category){
            return Category::all();
        }
        return response()->json(['message' => 'No Categorys yet'], 404);
    }

    public function store(Request $request)
    {
        return Category::create($request->all());
    }
    
    public function createCategory(Request $request){
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function showCategory($id)
    {
        $category = Category::find($id);
        if($category){
            return response()->json($category, 200);
        }
        return response()->json(['message' => 'Category not found'], 404);
    }

    public function updateCategory($id, Request $request){
        $category = Category::find($id);
        if($category){
            $category->update($request->all());
            return response()->json($category, 200);
        }
        return response()->json(['message' => 'Category not found'], 404);
    }

    public function deleteCategory($id, Request $request){
        $category = Category::find($id);
        $category->delete();
        return response()->json(null, 204);
    }
}
