<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['coverImage', 'tags'])
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->get();

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        $article->load(['coverImage', 'tags']);

        return view('articles.show', compact('article'));
    }
}
