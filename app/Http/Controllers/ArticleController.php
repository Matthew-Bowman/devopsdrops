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

        $tagIds = $article->tags->pluck('id');

        $relatedArticles = Article::where('id', '!=', $article->id)
            ->whereHas('tags', function ($query) use ($tagIds) {
                $query->whereIn('tags.id', $tagIds);
            })
            ->with(['coverImage', 'tags'])
            ->withCount([
                'tags as matching_tags_count' => function ($query) use ($tagIds) {
                    $query->whereIn('tags.id', $tagIds);
                }
            ])
            ->orderByDesc('matching_tags_count')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('articles.show', compact(
            'article',
            'relatedArticles'
        ));
    }
}
