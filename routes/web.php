<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [ArticleController::class, 'index'])
    ->name('articles.index');

// Articles
Route::get('/articles', [ArticleController::class, 'index'])
    ->name('articles.index');

Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])
    ->name('articles.show');
