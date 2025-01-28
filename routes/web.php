<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeriesController;
use App\Http\Middleware\EnsureNotALearner;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/series', [SeriesController::class, 'index'])->name('');

//    Route::middleware(EnsureNotALearner::class)->group(function (): void {
//    Route::get('/series', [SeriesController::class, 'index'])->name('');
//
//    });

});

require __DIR__.'/auth.php';
