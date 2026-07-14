<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;


class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::query()
            ->where('is_published', true)
            ->whereHas('articles')
            ->with([
                'coverImage'
            ])
            ->withCount('articles')
            ->get();

        return view('topics.index', compact('topics'));
    }

    public function show(Topic $topic)
    {
        abort_unless(
            $topic->is_published,
            404
        );


        $articles = $topic
            ->articles()
            ->with([
                'coverImage',
                'tags'
            ])
            ->latest('published_at')
            ->paginate(12);


        return view(
            'topics.show',
            compact(
                'topic',
                'articles'
            )
        );
    }
}
