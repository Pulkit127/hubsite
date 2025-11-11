<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdBanner;
use App\Models\Music;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Video;
use App\Models\Page;

use Auth;

class HomeController extends Controller
{
    // Homepage
    public function home()
    {
        $categories = Category::with('children')->get();
        $videos = Video::latest()->take(8)->get();
        $music = Music::latest()->take(8)->get();
        $pages = Page::all();
        $adbanner = AdBanner::all();
        return view('frontend.home', compact('categories', 'videos', 'music', 'pages','adbanner'));
    }

    // Search videos
    public function searchVideos(Request $request)
    {
        $query = $request->input('query');
        $categories = Category::all();
        $videos = Video::where('title', 'LIKE', "%{$query}%")->get();
        return view('frontend.home', compact('categories', 'videos'));
    }

    public function subcategory($id)
    {
        $subcategory = Category::with('videos')->findOrFail($id);

        $videos = $subcategory->videos()->latest()->paginate(12);

        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();
        $pages = Page::all();
        return view('frontend.videos.index', [
            'videos' => $videos,
            'title' => $subcategory->name,
            'categories' => $categories,
            'pages' => $pages
        ]);
    }

    public function musicSubCategory($id)
    {
        // 1️⃣ Find subcategory and eager-load its related music
        $subcategory = Category::with('music')->findOrFail($id);

        // 2️⃣ Get latest music under that subcategory (paginate 12)
        $music = $subcategory->music()->latest()->paginate(4);

        // 3️⃣ Load parent categories with children (for sidebar/menu)
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();

        $pages = Page::all();

        // 4️⃣ Return the music view
        return view('frontend.music.index', [
            'music' => $music,
            'title' => $subcategory->name,
            'categories' => $categories,
            'pages' => $pages
        ]);
    }

    public function show($slug)
    {
        // Find the page by slug
        $page = Page::where('slug', $slug)->first();

        // If not found, show 404
        if (!$page) {
            abort(404);
        }

        // Pass page data to view
        return view('frontend.pages.static-page', compact('page'));
    }

    public function download($id)
    {
        $video = Video::findOrFail($id);

        // 🔒 Check user subscription
        if (Auth::guard('web')->user()->plan_id === 0) {
            return redirect()->route('plans.upgrade')->with('error', 'Subscribe to download this file.');
        }

        // 🔐 Storage path
        $path = storage_path('app/public/' . $video->video_url);

        if (!file_exists($path)) {
            abort(404);
        }

        // 🧾 Hide real path – force download
        return response()->download($path, basename($path), [
            'Content-Type' => 'video/mp4',
            'Content-Disposition' => 'attachment; filename="' . $video->title . '.mp4"',
        ]);
    }
}
