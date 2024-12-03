<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;

use App\Http\Controllers\ProfileController;



Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    

    
});


Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');



// Routes for likes/dislikes
Route::post('/posts/{id}/like', [PostController::class, 'likePost'])->name('posts.like');
Route::post('/posts/{id}/dislike', [PostController::class, 'dislikePost'])->name('posts.dislike');
Route::post('/posts/{id}/toggle-like', [PostController::class, 'toggleLike']);



Route::get('/friends/search', [FriendController::class, 'search'])->name('friends.search');
Route::post('/friends/{id}/add', [FriendController::class, 'addFriend'])->name('friends.add');
Route::post('/friends/{id}/accept', [FriendController::class, 'acceptFriend'])->name('friends.accept');



// Routes for comments
Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
