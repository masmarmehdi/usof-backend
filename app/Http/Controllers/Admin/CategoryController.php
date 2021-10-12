<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Category,
    Post
};
use Illuminate\{
    Http\RedirectResponse,
    Http\Request,
    Support\Facades\DB
};


class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin/categories/show',compact('categories'));
    }

    public function create(){
        return view('category.create');
    }

    public function edit($category_id)
    {
        $category = Category::find($category_id)->first();
        return view('admin.categories.edit', compact('category'));
    }

    public function update($category_id, Request $request): RedirectResponse
    {
        $category_exist = DB::table('categories')->where('title', $request->input('title'))->first();

        if(!$category_exist){
            Category::where('id', $category_id)->update([
                'title' => $request->input('title')
            ]);
            return redirect()->route('category.index')->with('success', 'category updated successfully!');
        }
        return redirect()->route('category.index')->with('fail', 'Cannot update such category because the category name that you chose already exist!');

    }


    public function store(Request $request): RedirectResponse
    {
        Category::create($request->all());
        return redirect()->route('category.index')->with('success', 'Category created successfully!');
    }

    public function destroy($post_id): RedirectResponse
    {
        $category  = Category::find($post_id);
        if($category){
            $category->delete();
            return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
        }
        return redirect()->route('category.index')->with('fail', 'Category already deleted or does not exist in the first place!');
    }

    public function detail($category_id){
        $category = Category::find($category_id);
        $posts = Post::where('categories', $category->title)->paginate(10);
        return view('admin/categories/detail', compact('posts', 'category'));
    }
}
