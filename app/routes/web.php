<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LocaleController;

// Route group for optional locale ('en' or 'ru')
Route::group(['prefix' => '{locale?}', 'where' => ['locale' => 'en|ru']], function () {
    
    Route::get('/', function () {
        $locale = request()->segment(1);
        return view($locale === 'ru' ? 'ru.welcome' : 'welcome');
    })->name('welcome');

    Route::get('/terms', function () {
        $locale = request()->segment(1);
        return view($locale === 'ru' ? 'ru.terms' : 'terms');
    })->name('terms');

    Route::get('/privacy', function () {
        $locale = request()->segment(1);
        return view($locale === 'ru' ? 'ru.privacy' : 'privacy');
    })->name('privacy');

    Route::get('/dashboard', function () {
        $locale = request()->segment(1);
        return view($locale === 'ru' ? 'ru.dashboard' : 'dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
});

// Language switch route (global)
Route::post('/locale/change', [LocaleController::class, 'change'])->name('locale.change');

// Laravel Breeze/Fortify/etc. Auth routes
require __DIR__.'/auth.php';
