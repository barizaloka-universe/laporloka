<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::controller(\App\Http\Controllers\HomeController::class)
    ->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/about', 'about')->name('about');
    });

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
