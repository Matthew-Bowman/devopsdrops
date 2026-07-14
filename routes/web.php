<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\SearchController;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

use App\Models\Article;
use App\Models\Topic;


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


// Topics
Route::get(
    '/topics/{topic:slug}',
    [TopicController::class, 'show']
)
    ->name('topics.show');

Route::get('/topics', [TopicController::class, 'index'])
    ->name('topics.index');

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
        )->add(
            Url::create('/topics')
                ->setLastModificationDate(now())
        );

    Topic::where('is_published', true)
        ->each(function ($topic) use ($sitemap) {

            $sitemap->add(
                Url::create(
                    route(
                        'topics.show',
                        $topic
                    )
                )
            );
        });

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
