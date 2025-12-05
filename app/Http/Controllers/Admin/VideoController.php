<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
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
            'video_url'  =>  'required',
        ]);

        $file = $request->file('video_url');

        // save original to temporary location
        $tmpPath = $file->getRealPath();

        $ext = $file->getClientOriginalExtension() ?: 'mp4';
        $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time();
        $finalFilename = $name . '.mp4';
        $storageRelative = 'videos/' . $finalFilename;
        $storageAbsolute = storage_path('app/public/' . $storageRelative);

        // ensure dir
        if (!file_exists(dirname($storageAbsolute))) {
            mkdir(dirname($storageAbsolute), 0755, true);
        }

        // ffmpeg path -- if ffmpeg is in PATH, use 'ffmpeg' else absolute path like: C:\ffmpeg\bin\ffmpeg.exe
        $ffmpeg = 'C:\\ffmpeg\\bin\\ffmpeg.exe';

        // compression parameters (good starting point)
        $crf = 28;                // 18-23 high quality, 24-30 smaller files; tune as needed
        $preset = 'veryfast';     // slower presets -> better compression
        $scaleFilter = 'scale=1280:-2'; // resize width to 1280px keeping aspect ratio; remove if you want original resolution

        // build command
        $cmd = sprintf(
            '%s -y -i %s -vcodec libx264 -crf %d -preset %s -vf "%s" -acodec aac -b:a 128k -movflags +faststart %s 2>&1',
            escapeshellarg($ffmpeg),
            escapeshellarg($tmpPath),
            $crf,
            escapeshellarg($preset),
            $scaleFilter,
            escapeshellarg($storageAbsolute)
        );

        exec($cmd, $output, $ret);

        if ($ret !== 0) {
            Log::error('FFMPEG failed', ['cmd' => $cmd, 'output' => $output]);
            return back()->with('error', 'Video compression failed. Check server ffmpeg availability and logs.');
        }

        // save DB record
        $video = Video::create([
            'title' => $request->input('title'),
            'user_id' => Auth::guard('admin')->user()->id ?? null,
            'video_url' => $storageRelative,
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('videos.create')->with('success', 'Video uploaded and compressed!');
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

    public function statusUpdate($Video, $status)
    {
        $Video = Video::findOrFail($Video);

        // Toggle status
        $Video->status = $status == 'active' ? 'inactive' : 'active';
        $Video->save();
        return redirect()->back()->with('success', 'Video status updated successfully!');
    }
}
