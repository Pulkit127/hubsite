<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdBannerController extends Controller
{
    /**
     * Display a listing of the ad banners.
     */
    public function index()
    {
        $ads = AdBanner::latest()->paginate(10);
        return view('admin.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new ad banner.
     */
    public function create()
    {
        return view('admin.ads.create');
    }

    /**
     * Store a newly created ad banner.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|max:2048',
            'link' => 'nullable|url',
            'position' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        $path = $request->file('image')->store('ad-banners', 'public');

        AdBanner::create([
            'title' => $request->title,
            'image' => $path,
            'link' => $request->link,
            'position' => $request->position,
        ]);

        return redirect()->route('ads.index')->with('success', 'Ad banner created successfully.');
    }


    /**
     * Show the form for editing the ad banner.
     */
    public function edit(AdBanner $ad)
    {
        return view('admin.ads.edit', compact('ad'));
    }

    /**
     * Update the ad banner.
     */
    public function update(Request $request, AdBanner $adBanner)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|max:2048',
            'link' => 'nullable|url',
            'position' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['title', 'link', 'position']);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($adBanner->image);
            $data['image'] = $request->file('image')->store('ad-banners', 'public');
        }

        $adBanner->update($data);

        return redirect()->route('ads.index')->with('success', 'Ad banner updated successfully.');
    }

    /**
     * Remove the ad banner.
     */
    public function destroy(AdBanner $ad)
    {
        // Delete the image only if it exists
        if ($ad->image && Storage::disk('public')->exists($ad->image)) {
            Storage::disk('public')->delete($ad->image);
        }

        // Delete the record from DB
        $ad->delete();

        return redirect()->route('ads.index')->with('success', 'Ad banner deleted successfully.');
    }
}
