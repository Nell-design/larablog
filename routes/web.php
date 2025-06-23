<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/articles/create', [UserController::class, 'create'])->name('articles.create');
    Route::post('/articles', [UserController::class, 'store'])->name('articles.store');
    Route::post('/comments', [UserController::class, 'store'])->name('comments.store');
    Route::get('/articles/{article}/edit', [UserController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [UserController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [UserController::class, 'remove'])->name('articles.remove');
    Route::post('/articles/{article}/like', [UserController::class, 'like'])->name('articles.like');
});

require __DIR__ . '/auth.php';

// Public routes should be last to avoid conflicts
Route::get('/{user}/{article}', [PublicController::class, 'show'])->name('public.show');
Route::get('/{user}', [PublicController::class, 'index'])->name('public.index');