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
            ->whereNull('parent_entry_id')
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
            'parent',
        ]);

        $breadcrumbs = [
            [
                'label' => 'Home',
                'url' => route('home')
            ],
            [
                'label' => 'Encyclopedia',
                'url' => route('encyclopedia.index')
            ],
        ];


        foreach ($entry->ancestors() as $ancestor) {

            $breadcrumbs[] = [
                'label' => $ancestor->title,
                'url' => route(
                    'encyclopedia.show',
                    $ancestor
                )
            ];
        }


        $breadcrumbs[] = [
            'label' => $entry->title
        ];


        $exploreEntries = $entry->exploreEntries();

        $previousEntry = null;
        $nextEntry = null;

        if ($entry->parent_entry_id) {

            $previousEntry = Entry::where('parent_entry_id', $entry->parent_entry_id)
                ->where('published', true)
                ->where('sort_order', '<', $entry->sort_order)
                ->orderByDesc('sort_order')
                ->first();

            $nextEntry = Entry::where('parent_entry_id', $entry->parent_entry_id)
                ->where('published', true)
                ->where('sort_order', '>', $entry->sort_order)
                ->orderBy('sort_order')
                ->first();
        }

        $subtopics = $entry->children()
            ->where('published', true)
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        $hasMoreSubtopics = $entry->children()
            ->where('published', true)
            ->count() > 6;

        return view(
            'encyclopedia.show',
            compact(
                'entry',
                'exploreEntries',
                'breadcrumbs',
                'previousEntry',
                'nextEntry',
                'subtopics',
                'hasMoreSubtopics',
            )
        );
    }

    public function subtopics(Entry $entry)
    {
        $subtopics = $entry->children()
            ->where('published', true)
            ->orderBy('sort_order')
            ->paginate(24);

        return view('encyclopedia.subtopics', [
            'entry' => $entry,
            'subtopics' => $subtopics,
        ]);
    }
}
