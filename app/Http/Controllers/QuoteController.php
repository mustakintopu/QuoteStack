<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    // Show only quotes by the logged-in user
    public function index()
    {
        $quotes = Quote::with('tags')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('quotes.index', compact('quotes'));
    }

    // Show the Quote of the Day (any user's quote)
    public function quoteOfTheDay()
    {
        $quote = Cache::remember('quote_of_the_day', now()->addDay(), function () {
            return Quote::inRandomOrder()->with('tags')->first();
        });

        return view('quotes.daily', compact('quote'));
    }

    public function create()
    {
        $allTags = Tag::all();
        return view('quotes.create', compact('allTags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'author' => 'nullable',
            'built_in_tag' => 'nullable|string',
            'tags' => 'nullable|string',
        ]);

        $quote = Quote::create([
            'content' => $request->content,
            'author' => $request->author,
            'user_id' => Auth::id(),
        ]);

        $tagIds = [];

        if ($request->filled('built_in_tag')) {
            $builtInTag = trim($request->built_in_tag);
            $tag = Tag::firstOrCreate(['name' => $builtInTag]);
            $tagIds[] = $tag->id;
        }

        if ($request->filled('tags')) {
            $customTags = array_filter(array_map('trim', explode(',', $request->tags)));
            foreach ($customTags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
        }

        $quote->tags()->sync($tagIds);

        return redirect()->route('dashboard')->with('success', 'Quote added successfully.');
    }

    public function edit($id)
    {
        $quote = Quote::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('tags')
            ->firstOrFail();

        $tags = Tag::all();
        return view('quotes.edit', compact('quote', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $quote = Quote::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'content' => 'required',
            'author'  => 'nullable',
            'tags'    => 'nullable|string',
        ]);

        $quote->update([
            'content' => $request->content,
            'author'  => $request->author,
        ]);

        $tagIds = [];
        if ($request->filled('tags')) {
            $tagNames = array_filter(array_map('trim', explode(',', $request->tags)));
            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
        }

        $quote->tags()->sync($tagIds);

        return redirect()->route('dashboard')->with('success', 'Quote updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $quote = Quote::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $quote->delete();

        return redirect()->back()->with('success', 'Quote deleted.');
    }

    public function toggleFavorite($id)
{
    $quote = Quote::where('user_id', Auth::id())->findOrFail($id);
    $quote->is_favorite = !$quote->is_favorite;
    $quote->save();

    return back()->with('status', 'Quote favorite status updated!');
}

public function favorites()
{
    $quotes = Quote::where('user_id', Auth::id())
                   ->where('is_favorite', true)
                   ->with('tags')
                   ->latest()
                   ->get();

    return view('quotes.favorites', compact('quotes'));
}


    public function search(Request $request)
    {
        $search = $request->q;

        $quotesQuery = Quote::with('tags')
            ->where('user_id', Auth::id());

        if ($search) {
            $quotesQuery->where(function ($query) use ($search) {
                $query->where('author', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhereHas('tags', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $quotes = $quotesQuery->get();

        return view('quotes.index', compact('quotes'));
    }
}
