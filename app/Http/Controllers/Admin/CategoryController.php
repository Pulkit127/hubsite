<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::where('user_id', Auth::guard('admin')->user()->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10)       // 10 categories per page
            ->withQueryString(); // keep search term in pagination

        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        $categories = Category::where('user_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $request->merge(['user_id' => Auth::guard('admin')->user()->id]);
        Category::create($request->all());
        return redirect()->route('categories.create')->with('success', 'Category created successfully!');
    }

    public function edit(Category $category)
    {
        $categories = Category::where('user_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
