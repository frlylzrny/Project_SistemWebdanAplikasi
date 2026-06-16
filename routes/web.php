<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\BookmarkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| NOVEL FEATURES
|--------------------------------------------------------------------------
*/

Route::get('/search', [NovelController::class, 'search'])
    ->name('novels.search');

Route::get('/novel', [NovelController::class, 'detail'])
    ->name('novels.detail');

Route::get('/test-service', [NovelController::class, 'test']);

/*
|--------------------------------------------------------------------------
| BOOKMARK & HISTORY FEATURES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/bookmark', [BookmarkController::class, 'store'])
        ->name('bookmark.store');

    Route::get('/bookmarks', [BookmarkController::class, 'index'])
        ->name('bookmark.index');

    Route::delete('/bookmark/{id}', [BookmarkController::class, 'destroy'])
        ->name('bookmark.destroy');

    Route::get('/history', [NovelController::class, 'history'])
        ->name('history.index');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';