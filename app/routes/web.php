<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;




// Default English routes (no prefix)

Route::get('/', fn () => view('welcome'))->name('welcome'); // Add name
Route::get('/terms', fn () => view('terms'))->name('terms');
Route::get('/privacy', fn () => view('privacy'))->name('privacy');
Route::get('/dashboard', fn () => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Russian-localized routes (under /ru)
Route::prefix('ru')->group(function () {
    Route::get('/', fn () => view('ru.welcome'))->name('ru.welcome'); // Add name
    Route::get('/terms', fn () => view('ru.terms'))->name('ru.terms');
    Route::get('/privacy', fn () => view('ru.privacy'))->name('ru.privacy');
    Route::get('/dashboard', fn () => view('ru.dashboard'))->middleware(['auth', 'verified'])->name('ru.dashboard');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
});

// Locale switch POST endpoint
Route::post('/locale/change', [App\Http\Controllers\LocaleController::class, 'change'])->name('locale.change');

// Auth routes
require __DIR__.'/auth.php';
