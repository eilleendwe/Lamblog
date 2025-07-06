<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\PostController;

// Route dashboard without login
Route::get('/', function () {
    return view('dashboard', [
        'posts' => Post::with('user')->latest()->get(),
    ]);
})->name('dashboard');

Route::redirect('/dashboard', '/');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource route for posts
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // Route for my posts
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.mine');
});

require __DIR__ . '/auth.php';
