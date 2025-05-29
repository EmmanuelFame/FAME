<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Route Group with Optional Locale Prefix (default: en)
Route::group(['prefix' => '{locale?}', 'where' => ['locale' => 'en|ru']], function () {

    Route::get('/', function () {
        return view(request()->segment(1) === 'ru' ? 'ru.welcome' : 'welcome');
    })->name('welcome');

    Route::get('/terms', function () {
        return view(request()->segment(1) === 'ru' ? 'ru.terms' : 'terms');
    })->name('terms');

    Route::get('/privacy', function () {
        return view(request()->segment(1) === 'ru' ? 'ru.privacy' : 'privacy');
    })->name('privacy');

    Route::get('/dashboard', function () {
        return view(request()->segment(1) === 'ru' ? 'ru.dashboard' : 'dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
});

