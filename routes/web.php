<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Http\Controllers\QuoteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SettingsController;
use App\Http\Middleware\PreventBackHistory;

// ===================
// Public Routes
// ===================

// Home page with login/signup buttons
Route::view('/', 'home')->name('home');

// Quote of the Day (public)
Route::get('/quote-of-the-day', [QuoteController::class, 'quoteOfTheDay'])->name('quoteOfTheDay');

// ===================
// Authentication Routes
// ===================

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Manual Logout (with session destroy)
Route::post('/logout', function (Request $request) {
    Auth::logout();
    Session::flush();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login')->with('success', 'Logged out successfully.');
})->name('logout');

// ===================
// Protected Routes
// ===================

Route::middleware(['auth', PreventBackHistory::class])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Quotes
    Route::resource('quotes', QuoteController::class);
    Route::get('/search', [QuoteController::class, 'search'])->name('quotes.search');

    Route::post('/quotes/{id}/favorite', [QuoteController::class, 'toggleFavorite'])->name('quotes.favorite');
    Route::get('/favorites', [QuoteController::class, 'favorites'])->name('quotes.favorites');


    // Tags
    Route::resource('tags', TagController::class);

    // Profile & Settings
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile');
        Route::get('/profile/edit', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
        Route::patch('/profile/password', 'updatePassword')->name('profile.password.update');
    });

    Route::controller(SettingsController::class)->group(function () {
        Route::get('/settings', 'index')->name('settings');
        Route::post('/settings', 'update')->name('settings.update');
    });
});
