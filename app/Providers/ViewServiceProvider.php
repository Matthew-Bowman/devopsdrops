<?php

namespace App\Providers;

use App\Models\Entry;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Models\Topic;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {

            $view->with([

                'footerTopics' => Topic::withCount([
                    'articles',
                    'entries'
                ])
                    ->havingRaw('(articles_count + entries_count) > 0')
                    ->orderByRaw('(articles_count + entries_count) DESC')
                    ->limit(8)
                    ->get(),


                'footerEntries' => Entry::where('published', true)
                    ->whereNull('parent_entry_id')
                    ->orderBy('title')
                    ->limit(8)
                    ->get(),

            ]);
        });
    }
}
