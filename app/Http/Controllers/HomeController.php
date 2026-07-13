<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::with(['coverImage', 'tags'])
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->limit(6)
            ->get();

        $topics = Tag::withCount('articles')
            ->orderByDesc('articles_count')
            ->limit(6)
            ->get();

        return view('home', compact('articles', 'topics'));
    }
}
