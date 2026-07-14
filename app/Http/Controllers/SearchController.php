<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $articles = collect();

        if ($query) {
            $articles = Article::search($query)
                ->get();
        }

        return view('search.search', [
            'articles' => $articles,
            'query' => $query,
        ]);
    }
}
