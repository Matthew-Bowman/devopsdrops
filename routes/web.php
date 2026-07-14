<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SearchController;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

use App\Models\Article;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Articles
Route::get('/articles', [ArticleController::class, 'index'])
    ->name('articles.index');

Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])
    ->name('articles.show');


// Search

Route::get('/search', [SearchController::class, 'index'])
    ->name('search');

// Sitemap
Route::get('/sitemap.xml', function () {

    $sitemap = Sitemap::create()
        ->add(
            Url::create('/')
                ->setLastModificationDate(now())
        )
        ->add(
            Url::create('/articles')
                ->setLastModificationDate(
                    \Carbon\Carbon::parse(Article::max('updated_at'))
                )
        )->add(
            Url::create('/search')
                ->setLastModificationDate(now())
        );

    Article::query()
        ->whereNotNull('published_at')
        ->each(function ($article) use ($sitemap) {

            $sitemap->add(
                Url::create("/articles/{$article->slug}")
                    ->setLastModificationDate(
                        \Carbon\Carbon::parse(Article::max('updated_at'))
                    )
            );
        });

    return $sitemap->toResponse(request());
});
