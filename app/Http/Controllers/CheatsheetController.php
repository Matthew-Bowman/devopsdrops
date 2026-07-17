<?php

namespace App\Http\Controllers;

use App\Models\Media;

class CheatsheetController extends Controller
{

    public function index()
    {
        $topics = Media::whereJsonContains('tags', 'type:cheatsheet')
            ->get()
            ->pluck('tags')
            ->flatten()
            ->filter(fn($tag) => str_starts_with($tag, 'topic:'))
            ->map(fn($tag) => str_replace('topic:', '', $tag))
            ->unique()
            ->sort();


        return view('cheatsheets.index', compact('topics'));
    }



    public function show($topic)
    {
        $cheatsheets = Media::whereJsonContains(
            'tags',
            'type:cheatsheet'
        )
            ->whereJsonContains(
                'tags',
                "topic:$topic"
            )
            ->get();


        abort_if($cheatsheets->isEmpty(), 404);


        return view('cheatsheets.show', [
            'topic' => $topic,
            'cheatsheets' => $cheatsheets
        ]);
    }



    public function view($topic, $slug)
    {

        $cheatsheets = Media::whereJsonContains(
            'tags',
            'type:cheatsheet'
        )
            ->whereJsonContains(
                'tags',
                "topic:$topic"
            )
            ->get();



        $cheatsheet = $cheatsheets->first(function ($media) use ($slug) {

            return collect($media->tags)
                ->contains("slug:$slug");
        });



        abort_unless($cheatsheet, 404);



        return view('cheatsheets.view', [

            'topic' => $topic,

            'slug' => $slug,

            'cheatsheet' => $cheatsheet,

            'relatedCheatsheets' => $cheatsheets

        ]);
    }
}
