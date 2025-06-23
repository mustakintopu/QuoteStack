<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Only fetch quotes for the logged-in user
        $quotes = Quote::where('user_id', Auth::id())->with('tags')->latest()->get();

        return view('dashboard', compact('quotes'));
    }
}
