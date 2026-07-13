@extends('layouts.app')

@section('title', "Articles - config('app.name')")

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="mb-10">
        <h1 class="text-4xl font-bold mb-3">
            Articles
        </h1>

        <p class="text-gray-400">
            Tutorials, guides, and insights covering DevOps, cloud infrastructure, and engineering.
        </p>
    </div>


    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">

        @foreach($articles as $article)

        <article class="group bg-gray-900 rounded-xl overflow-hidden border border-gray-800 hover:border-blue-500 transition duration-300">

            @if($article->coverImage)
            <a href="{{ route('articles.show', $article) }}">
                <img
                    src="{{ Storage::url($article->coverImage->path) }}"
                    alt="{{ $article->coverImage->alt_text ?? $article->title }}"
                    class="w-full aspect-video object-cover group-hover:scale-105 transition duration-300">
            </a>
            @endif


            <div class="p-6">

                <h2 class="text-2xl font-bold mb-3">
                    <a
                        href="{{ route('articles.show', $article) }}"
                        class="hover:text-blue-400 transition">
                        {{ $article->title }}
                    </a>
                </h2>


                <p class="text-gray-400 mb-5 line-clamp-3">
                    {{ $article->excerpt }}
                </p>


                <div class="flex items-center justify-between text-sm text-gray-500">

                    <span>
                        {{ $article->published_at->format('d M Y') }}
                    </span>

                    <span>
                        {{ $article->reading_time }} min read
                    </span>

                </div>

            </div>

        </article>

        @endforeach

    </div>

</div>

@endsection