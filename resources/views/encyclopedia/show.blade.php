@extends('layouts.app')

@section('title', $entry->title)
@section('description', $entry->excerpt)
@section('og_title', $entry->title)
@section('og_description', $entry->excerpt)
@section('og_type', 'article')
@section('published_time', optional($entry->published_at)->toISOString())

@section('content')

<style>
    .entry-content h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .entry-content h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: .75rem;
    }

    .entry-content p {
        margin-bottom: 1rem;
        line-height: 1.8;
        color: #d1d5db;
    }

    .entry-content ul,
    .entry-content ol {
        margin: 1rem 0;
        padding-left: 2rem;
    }

    .entry-content li {
        margin-bottom: .5rem;
    }

    .entry-content :not(pre)>code {
        background: #1f2937;
        padding: .2rem .4rem;
        border-radius: .25rem;
        font-size: .9em;
    }

    .entry-content pre[class*="language-"] {
        background: #111827;
        border-radius: .5rem;
        overflow-x: auto;
        margin: 1rem 0;
    }

    .entry-content pre code {
        background: transparent;
        border-radius: 0;
        font-size: inherit;
    }
</style>

<script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "TechArticle",
        "headline": "{{ $entry->title }}",
        "datePublished": "{{ $entry->published_at }}",
        "author": {
            "@type": "Organization",
            "name": "{{ config('app.name') }}"
        }
    }
</script>


<article>

    @section('breadcrumbs')

    <x-breadcrumbs :items="[
    [
        'label' => 'Home',
        'url' => route('home')
    ],
    [
        'label' => 'Encyclopedia',
        'url' => route('encyclopedia.index')
    ],
    [
        'label' => optional($entry->topic)->name,
        'url' => $entry->topic
            ? route('encyclopedia.topic.show', $entry->topic)
            : null
    ],
    [
        'label' => $entry->title
    ]
]" />

    @endsection


    <h1 class="text-5xl font-bold mb-4">
        {{ $entry->title }}
    </h1>


    @can('update', $entry)

    <div class="mb-6">

        <a href="{{ route('filament.admin.resources.entries.edit', $entry) }}"
            class="
                inline-flex
                items-center
                rounded-lg
                border
                border-gray-700
                bg-gray-900
                px-4
                py-2
                text-sm
                text-gray-300
                hover:text-white
                hover:border-gray-500
                transition">
            Edit Entry
        </a>

    </div>

    @endcan


    <p class="text-xl text-gray-400 leading-relaxed max-w-3xl mb-6">
        {{ $entry->excerpt }}
    </p>


    <p class="text-gray-400 mb-8">
        @if($entry->published_at)
        Published {{ $entry->published_at->format('d M Y') }}
        @endif

        @if($entry->entryType)
        · {{ $entry->entryType->name }}
        @endif
    </p>


    <div class="flex flex-wrap gap-2 mb-8">

        @foreach($entry->tags as $tag)

        <x-tag>
            {{ $tag->name }}
        </x-tag>

        @endforeach

    </div>


    <div class="entry-content max-w-none">
        {!! $entry->content !!}
    </div>


    @if($relatedEntries->count())

    <section class="mt-20 border-t border-gray-800 pt-12">

        <div class="rounded-xl bg-gray-900/40 border border-gray-800 p-8">

            <h2 class="text-3xl font-bold mb-2">
                Related Entries
            </h2>

            <p class="text-gray-400 mb-8">
                Continue exploring related concepts and technologies.
            </p>


            <div class="grid md:grid-cols-3 gap-8">

                @foreach($relatedEntries as $relatedEntry)

                <a href="{{ route('entries.show', $relatedEntry->slug) }}"
                    class="block rounded-xl border border-gray-800 bg-gray-900/40 p-6 hover:border-gray-600 transition">

                    <h3 class="text-xl font-semibold mb-2">
                        {{ $relatedEntry->title }}
                    </h3>

                    <p class="text-gray-400">
                        {{ $relatedEntry->excerpt }}
                    </p>

                </a>

                @endforeach

            </div>

        </div>

    </section>

    @endif


</article>

@endsection