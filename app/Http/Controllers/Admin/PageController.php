<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    // List all pages
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    // Show create page form
    public function create()
    {
        return view('admin.pages.create');
    }

    // Store new page
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'contents' => 'required|string',
        ]);

        Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->contents,
        ]);

        return redirect()->route('pages.create')->with('success', 'Page created successfully.');
    }

    // Show edit page form
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    // Update page
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'contents' => 'required|string',
        ]);

        $page->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->contents,
        ]);

        return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
    }

    // Delete page
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }
}
