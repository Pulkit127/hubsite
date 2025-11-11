<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Page;

class FrontProfileController extends Controller
{
    // Show user profile
    public function index()
    {
        $user = Auth::guard('web')->user();
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();
        $pages = Page::all();
        return view('frontend.profile.index', compact('user', 'categories', 'pages'));
    }

    // Update user profile
    public function update(Request $request)
    {
        $user = Auth::guard('web')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    // Show change password form
    public function changePassword()
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();
        $pages = Page::all();
        return view('frontend.profile.change_password', compact('categories','pages'));
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::guard('web')->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password does not match.');
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success', 'Password changed successfully.');
    }
}
