<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\EncyclopediaController;
use App\Http\Controllers\SearchController;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

use App\Models\Article;
use App\Models\Entry;
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

// Encyclopedia
Route::get('/encyclopedia', [EncyclopediaController::class, 'index'])
    ->name('encyclopedia.index');

Route::get('/encyclopedia/topics/{topic:slug}', [EncyclopediaController::class, 'topic'])
    ->name('encyclopedia.topic.show');

Route::get('/encyclopedia/{entry:slug}', [EncyclopediaController::class, 'show'])
    ->name('encyclopedia.show');

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
        )
        ->add(
            Url::create('/encyclopedia')
                ->setLastModificationDate(
                    \Carbon\Carbon::parse(Entry::max('updated_at'))
                )
        )
        ->add(
            Url::create('/search')
                ->setLastModificationDate(now())
        )
        ->add(
            Url::create('/topics')
                ->setLastModificationDate(now())
        );


    /*
    |--------------------------------------------------------------------------
    | Article Topics
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | Articles
    |--------------------------------------------------------------------------
    */

    Article::query()
        ->whereNotNull('published_at')
        ->each(function ($article) use ($sitemap) {

            $sitemap->add(
                Url::create(
                    route(
                        'articles.show',
                        $article
                    )
                )
                    ->setLastModificationDate(
                        $article->updated_at
                    )
            );
        });


    /*
    |--------------------------------------------------------------------------
    | Encyclopedia Topics
    |--------------------------------------------------------------------------
    */

    Topic::where('is_published', true)
        ->whereHas('entries', function ($query) {
            $query->where('published', true);
        })
        ->each(function ($topic) use ($sitemap) {

            $sitemap->add(
                Url::create(
                    route(
                        'encyclopedia.topic.show',
                        $topic
                    )
                )
            );
        });


    /*
    |--------------------------------------------------------------------------
    | Encyclopedia Entries
    |--------------------------------------------------------------------------
    */

    Entry::query()
        ->where('published', true)
        ->each(function ($entry) use ($sitemap) {

            $sitemap->add(
                Url::create(
                    route(
                        'encyclopedia.show',
                        $entry
                    )
                )
                    ->setLastModificationDate(
                        $entry->updated_at
                    )
            );
        });


    return $sitemap->toResponse(request());
});
