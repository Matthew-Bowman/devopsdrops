@extends('layouts.app')

@section('title', $query ? "Search: {$query}" : 'Search')

@section('content')

<div class="max-w-5xl mx-auto">

    @section('breadcrumbs')

    <x-breadcrumbs :items="[
    [
        'label' => 'Home',
        'url' => '/'
    ],
    [
        'label' => 'Search'
    ]
]" />

    @endsection

    <section class="py-12">

        @if($query)

        <h1 class="text-4xl font-bold mb-2">
            Search results
        </h1>

        <p class="text-gray-400 mb-6">
            Showing {{ $articles->count() + $entries->count() }}
            result{{ ($articles->count() + $entries->count()) === 1 ? '' : 's' }}
            for "{{ $query }}"
        </p>

        @else

        <h1 class="text-4xl font-bold mb-4">
            Search articles
        </h1>

        <p class="text-gray-400 mb-8">
            Find guides, tutorials, and resources covering DevOps, cloud infrastructure, Linux, automation, and more.
        </p>

        @endif

        <form action="{{ route('search') }}" method="GET" class="mb-10">

            <div class="flex gap-3">

                <input
                    type="search"
                    name="q"
                    value="{{ $query ?? '' }}"
                    placeholder="Search articles..."
                    class="flex-1 rounded-lg border border-gray-700 bg-gray-900 px-4 py-3 text-white placeholder-gray-500 focus:border-blue-500 focus:outline-none">

                <x-button type="submit">
                    Search
                </x-button>

            </div>

        </form>

        @if($entries->count())

        <section class="mb-12">

            <div class="mb-6">

                <h2 class="text-3xl font-bold mb-2">
                    Encyclopedia
                </h2>

                <p class="text-gray-400">
                    Reference entries covering DevOps concepts, technologies, and infrastructure.
                </p>

            </div>


            <div class="grid md:grid-cols-2 gap-6">

                @foreach($entries as $entry)

                <a href="{{ route('encyclopedia.show', $entry) }}"
                    class="
                group
                flex flex-col
                block
                rounded-xl
                border
                border-gray-800
                bg-gray-900/40
                p-6
                transition
                hover:border-indigo-500
                hover:-translate-y-1
            ">


                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">

                        @if($entry->topic)

                        <span>
                            {{ $entry->topic->name }}
                        </span>

                        @endif


                        @if($entry->entryType)

                        @if($entry->topic)
                        <span>·</span>
                        @endif

                        <span>
                            {{ $entry->entryType->name }}
                        </span>

                        @endif

                    </div>


                    <h3 class="
                text-2xl
                font-bold
                mb-3
                group-hover:text-indigo-400
                transition
            ">
                        {{ $entry->title }}
                    </h3>


                    @if($entry->parent)

                    <p class="text-sm text-gray-500 mb-3">

                        Part of:
                        <span class="text-gray-400">
                            {{ $entry->parent->title }}
                        </span>

                    </p>

                    @endif


                    <p class="text-gray-400 leading-relaxed mb-4">
                        {{ Str::limit($entry->excerpt, 180) }}
                    </p>


                    <div class="
                mt-auto
                flex
                items-center
                justify-between
                text-sm
            ">

                        <span class="
                    text-indigo-400
                    group-hover:text-indigo-300
                    transition
                ">
                            View entry
                        </span>


                        <span class="
                    text-indigo-400
                    group-hover:translate-x-1
                    transition
                ">
                            →
                        </span>

                    </div>


                </a>

                @endforeach

            </div>

        </section>

        @endif


        @if($articles->count())

        <div class="space-y-6">

            @foreach($articles as $article)

            <article class="relative flex flex-col md:flex-row gap-6 border border-gray-800 rounded-xl p-6 hover:border-gray-700 hover:-translate-y-1 transition">

                {{-- Clickable overlay --}}
                <a href="{{ route('articles.show', $article->slug) }}"
                    class="absolute inset-0 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    aria-label="{{ $article->title }}">
                </a>


                {{-- Image --}}
                @if($article->coverImage)

                <div class="md:w-64 shrink-0 relative z-10 pointer-events-none">

                    <img
                        src="{{ $article->coverImage->url('M') }}"
                        alt="{{ $article->coverImage->alt_text }}"
                        class="w-full h-40 object-cover rounded-lg">

                </div>

                @endif


                {{-- Content --}}
                <div class="flex-1 relative z-10 pointer-events-none">

                    <h2 class="text-2xl font-bold mb-2">
                        {{ $article->title }}
                    </h2>


                    <p class="text-gray-400 mb-4">
                        {{ Str::limit($article->excerpt, 180) }}
                    </p>


                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500">

                        <span>
                            {{ $article->published_at->format('d M Y') }}
                        </span>

                        <span>
                            ·
                        </span>

                        <span>
                            {{ $article->reading_time }} min read
                        </span>

                    </div>


                    @if($article->tags->count())

                    <div class="flex flex-wrap gap-2 mt-4">

                        @foreach($article->tags as $tag)

                        <x-tag>
                            {{ $tag->name }}
                        </x-tag>

                        @endforeach

                    </div>

                    @endif

                </div>

            </article>

            @endforeach

        </div>

        @elseif($query && !$articles->count() && !$entries->count())

        <div class="border border-gray-800 rounded-xl p-8 text-center">

            <p class="text-gray-400">
                No results found for "{{ $query }}".
            </p>

        </div>

        @endif

    </section>

</div>

@endsection