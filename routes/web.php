<?php

use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogController::class, 'index']);
Route::get('/blogs/{blog:slug}', [BlogController::class, 'show']);

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'create']);
    Route::post('/register', [AuthController::class, 'store']);
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login', [AuthController::class, 'post_login']);
});


Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::post('/blogs/{blog:slug}/comments', [CommentController::class, 'store']);
Route::post('/blogs/{blog:slug}/subscription', [BlogController::class, 'subscriptionHandler']);
Route::get('/comments/edit/{comment}/',[CommentController::class,'edit'])->name('comments.edit')->middleware('can:edit,comment');
Route::put('/comments/update/{comment}/',[CommentController::class,'update'])->name('comments.update')->middleware('can:update,coment');
Route::delete('/comments/update/{comment}/',[CommentController::class,'delete'])->name('comments.delete')->middleware('can:delete,comment');


//admin routes
Route::middleware('can:admin')->group(function() {
    Route::get('/admin/blogs', [AdminBlogController::class, 'index']);
    Route::get('/admin/blogs/create', [AdminBlogController::class, 'create']);
    Route::post('/admin/blogs/store', [AdminBlogController::class, 'store']);
    Route::delete('/admin/blogs/{blog:slug}/delete', [AdminBlogController::class, 'destroy']);
    Route::get('/admin/blogs/{blog:slug}/edit', [AdminBlogController::class, 'edit']);
    Route::patch('/admin/blogs/{blog:slug}/update', [AdminBlogController::class, 'update']);
});





