<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Topic;

class EncyclopediaController extends Controller
{
    /**
     * Encyclopedia homepage
     */
    public function index()
    {
        $topics = Topic::where('is_published', true)
            ->whereHas('entries', function ($query) {
                $query->where('published', true);
            })
            ->withCount([
                'entries' => function ($query) {
                    $query->where('published', true);
                }
            ])
            ->orderBy('name')
            ->get();


        $recentEntries = Entry::with([
            'topic',
            'entryType'
        ])
            ->where('published', true)
            ->latest()
            ->limit(6)
            ->get();


        return view(
            'encyclopedia.index',
            compact(
                'topics',
                'recentEntries'
            )
        );
    }


    /**
     * Show all entries under a topic
     */
    public function topic(Topic $topic)
    {
        $entries = Entry::with([
            'entryType'
        ])
            ->where('topic_id', $topic->id)
            ->where('published', true)
            ->orderBy('title')
            ->get();


        return view(
            'encyclopedia.topic',
            compact(
                'topic',
                'entries'
            )
        );
    }


    /**
     * Show single encyclopedia entry
     */
    public function show(Entry $entry)
    {
        abort_if(!$entry->published, 404);


        $entry->load([
            'topic',
            'entryType',
            'tags',
            'relatedEntries'
        ]);


        $relatedEntries = $entry->relatedEntries
            ->where('published', true);


        return view(
            'encyclopedia.show',
            compact(
                'entry',
                'relatedEntries'
            )
        );
    }
}
