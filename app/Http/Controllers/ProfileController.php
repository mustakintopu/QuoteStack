<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;  // For file storage
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    // Show profile
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        return view('profile', compact('user'));
    }

    // Show edit form
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    // Update profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username,' . $user->id,
            'bio' => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|max:2048', // max 2MB
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');

            $user->profile_picture = $path;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->bio = $request->bio;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully');

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Delete profile picture if exists
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Delete user's quotes and their associations
        $user->quotes()->delete();

        // Delete the user
        Auth::logout();
        $user->delete();

        // Clear session
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Your account has been permanently deleted.');
    }
}
