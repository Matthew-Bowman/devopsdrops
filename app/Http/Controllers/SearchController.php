<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Entry;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return view('search.search', [
                'query' => null,
                'articles' => collect(),
                'entries' => collect(),
            ]);
        }

        $articles = Article::search($query)
            ->get();

        $entries = Entry::search($query)
            ->where('published', true)
            ->get();

        return view('search.search', [
            'query' => $query,
            'articles' => $articles,
            'entries' => $entries,
        ]);
    }
}
