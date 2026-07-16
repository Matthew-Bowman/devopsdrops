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

    <x-breadcrumbs :items="$breadcrumbs" />

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


    @if($exploreEntries->count())

    <section class="mt-20 border-t border-gray-800 pt-12">

        <div class="rounded-xl bg-gray-900/40 border border-gray-800 p-8">

            <h2 class="text-3xl font-bold mb-2">
                Continue Exploring
            </h2>

            <p class="text-gray-400 mb-8">
                Explore related concepts and continue through the encyclopedia.
            </p>


            <div class="grid md:grid-cols-3 gap-6">

                @foreach($exploreEntries as $exploreEntry)

                <a href="{{ route('encyclopedia.show', $exploreEntry) }}"
                    class="
                    group
                    flex flex-col
                    block
                    rounded-xl
                    border
                    border-gray-800
                    bg-gray-950/40
                    p-6
                    transition
                    hover:border-indigo-500/50
                    hover:-translate-y-1
                ">


                    @if($exploreEntry->id === $entry->parent_entry_id)

                    <div class="text-xs uppercase tracking-wider text-indigo-400 mb-3">
                        Parent Entry
                    </div>

                    @elseif($exploreEntry->parent_entry_id === $entry->parent_entry_id)

                    <div class="text-xs uppercase tracking-wider text-gray-500 mb-3">
                        Related Entry
                    </div>

                    @else

                    <div class="text-xs uppercase tracking-wider text-gray-500 mb-3">
                        Explore Next
                    </div>

                    @endif


                    <h3 class="
                    text-xl
                    font-semibold
                    mb-3
                    text-white
                    group-hover:text-indigo-300
                    transition
                ">
                        {{ $exploreEntry->title }}
                    </h3>


                    @if($exploreEntry->excerpt)

                    <p class="text-gray-400 leading-relaxed">
                        {{ Str::limit($exploreEntry->excerpt, 120) }}
                    </p>

                    @endif


                    <div class="
                    mt-auto
                    pt-4
                    flex
                    items-center
                    text-sm
                    text-indigo-400
                    group-hover:text-indigo-300
                    transition
                ">

                        View entry

                        <span class="ml-2 group-hover:translate-x-1 transition">
                            →
                        </span>

                    </div>


                </a>

                @endforeach

            </div>

        </div>

    </section>

    @endif


</article>

@endsection