<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Article;


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


// Sitemap
Route::get('/sitemap.xml', function () {

    return Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/articles'))
        ->add(
            Article::all()->map(
                fn($article) =>
                Url::create("/articles/{$article->slug}")
            )
        )
        ->toResponse(request());
});
