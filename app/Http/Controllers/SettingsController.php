<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('settings.index', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'email_notifications' => 'nullable|boolean',
            'theme' => 'required|string|in:light,dark',
            'language' => 'required|string|in:en,es,fr',
        ]);

        $user = Auth::user();

        $settings = array_merge($user->settings ?? [], [
            'email_notifications' => $request->has('email_notifications'),
            'theme' => $request->input('theme'),
            'language' => $request->input('language'),
        ]);

        $user->settings = $settings;
        $user->save();

        return redirect()->route('settings')->with('success', 'Settings updated successfully.');
    }
}
