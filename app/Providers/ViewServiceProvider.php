<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Models\Topic;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {

            $view->with(
                'footerTopics',
                Topic::withCount('articles')
                    ->having('articles_count', '>', 0)
                    ->orderByDesc('articles_count')
                    ->limit(8)
                    ->get()
            );
        });
    }
}
