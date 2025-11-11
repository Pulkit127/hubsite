<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Music;
use App\Models\Category;

class MusicController extends Controller
{
    // List all music
    public function index()
    {
        $music = Music::latest()->paginate(12);
        return view('admin.music.index', compact('music'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        return view('admin.music.create',compact('categories'));
    }

    // Store new music
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'music_file' => 'required|mimes:mp3,wav,ogg|max:102400', // 100 MB max
        ]);

        $path = $request->file('music_file')->store('music', 'public');

        Music::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'music_file' => $path,
        ]);

        return redirect()->route('music.index')->with('success', 'Music added successfully.');
    }

    // Show edit form
    public function edit(Music $music)
    {
        return view('admin.music.edit', compact('music'));
    }

    // Update music
    public function update(Request $request, Music $music)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => $request->category_id,
            'music_file' => 'nullable|mimes:mp3,wav,ogg|max:102400',
        ]);

        $data = $request->only('title', 'category_id');

        if ($request->hasFile('music_file')) {
            Storage::disk('public')->delete($music->music_file);
            $data['music_file'] = $request->file('music_file')->store('music', 'public');
        }

        $music->update($data);
        return redirect()->route('music.index')->with('success', 'Music updated successfully.');
    }

    // Delete music
    public function destroy(Music $music)
    {
        Storage::disk('public')->delete($music->music_file);
        $music->delete();
        return redirect()->route('music.index')->with('success', 'Music deleted successfully.');
    }
}
