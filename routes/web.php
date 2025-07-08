<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\PostController;

// Route dashboard without login
Route::get('/', function () {
    return view('dashboard', [
        'posts' => Post::with('user')->latest()->paginate(5),
    ]);
})->name('dashboard');

Route::redirect('/dashboard', '/');

//Route for /trending
Route::get('/trending', [PostController::class, 'trendingToday'])->name('posts.trending');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource route for posts
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // Route for my posts
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.mine');

    // Route to show a single post
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    // Route to comment a post
    Route::post('/posts/{post}/comments', [PostController::class, 'storeComment'])->name('comments.store');

    // Route to like a post
    Route::post('/posts/{post}/like', [PostController::class, 'likePost'])->name('posts.like');
});

require __DIR__ . '/auth.php';
