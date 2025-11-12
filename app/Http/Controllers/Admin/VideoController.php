<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $videos = Video::with('category')
            ->where('user_id', Auth::guard('admin')->user()->id)
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate(10)      // 10 videos per page
            ->withQueryString(); // keeps search query in pagination links

        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.videos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('video_url')) {
            $videoPath = $request->file('video_url')->store('videos', 'public');
            $data['video_url'] = $videoPath;
        } else {
            $data['video_url'] = '';
        }

        $data['user_id'] = Auth::guard('admin')->user()->id;
        Video::create($data);
        return redirect()->route('videos.create')->with('success', 'Video created successfully!');
    }

    public function edit(Video $video)
    {
        $categories = Category::all();
        return view('admin.videos.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|mimes:mp4,mov,ogg,qt',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
        ]);


        $data = $request->all();

        if ($request->hasFile('video_url')) {
            $videoPath = $request->file('video_url')->store('videos', 'public');
            $data['video_url'] = $videoPath;
        } else {
            $data['video_url'] = $data['url'];
        }

        $video->update($data);
        return redirect()->route('videos.index')->with('success', 'Video updated successfully!');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video deleted successfully!');
    }
}
