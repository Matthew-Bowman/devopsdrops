<?php

namespace App\Http\Controllers;

use App\Models\Article;
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
            ]);
        }

        $articles = Article::search($query)->get();

        return view('search.search', [
            'query' => $query,
            'articles' => $articles,
        ]);
    }
}
