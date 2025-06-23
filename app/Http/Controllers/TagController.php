<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the tags.
     */
    public function index()
    {
        $tags = Tag::withCount('quotes')
            ->whereHas('quotes', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->orderBy('name')
            ->get();

        return view('tags.index', compact('tags'));
    }

    /**
     * Store a newly created tag in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name'
        ]);

        $tag = Tag::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Tag created successfully');
    }

    /**
     * Update the specified tag in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id
        ]);

        $tag->update([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Tag updated successfully');
    }

    /**
     * Remove the specified tag from storage.
     */
    public function destroy(Tag $tag)
    {
        // Check if tag is being used
        if ($tag->quotes()->where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('error', 'Cannot delete a tag that is being used by quotes');
        }

        $tag->delete();
        return redirect()->back()->with('success', 'Tag deleted successfully');
    }
}
