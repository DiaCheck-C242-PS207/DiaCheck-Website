<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PredictionsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::resource('predictions', PredictionsController::class);
    Route::post('/predictions', [PredictionsController::class, 'predictions']);

    Route::get('/articles', [ArticlesController::class, 'index'])->name('articles.index');
    Route::get('/article/{slug}', [ArticlesController::class, 'show'])->name('articles.show');

    Route::middleware('IsAdmin')->group(function () {
        Route::get('/articles/create', [ArticlesController::class, 'create'])->name('articles.create');
        Route::post('/articles', [ArticlesController::class, 'store'])->name('articles.store');
        Route::get('/articles/{slug}/edit', [ArticlesController::class, 'edit'])->name('articles.edit');
        Route::put('/articles/{id}', [ArticlesController::class, 'update'])->name('articles.update');
        Route::delete('/articles/{id}', [ArticlesController::class, 'destroy'])->name('articles.destroy');
    });
    
    Route::resource('profile', ProfileController::class);
    Route::delete('/profile/{id}/delete-avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.delete.avatar');    
});


Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');