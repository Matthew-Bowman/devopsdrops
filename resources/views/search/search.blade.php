@extends('layouts.app')

@section('title', 'Search')

@section('content')

<h1 class="text-4xl font-bold mb-8">
    Search
</h1>


<form method="GET" action="/search">

    <input
        type="search"
        name="q"
        value="{{ $query }}"
        placeholder="Search articles..."
        class="w-full rounded-lg bg-gray-900 border border-gray-700 px-4 py-3 text-white">

</form>


@if($query)

<h2 class="mt-8 mb-4 text-xl">
    Results for "{{ $query }}"
</h2>


@forelse($articles as $article)

<a href="/articles/{{ $article->slug }}"
    class="block border-b border-gray-800 py-4">

    <h3 class="text-xl font-bold">
        {{ $article->title }}
    </h3>

    <p class="text-gray-400">
        {{ $article->excerpt }}
    </p>

</a>

@empty

<p class="text-gray-400">
    No articles found.
</p>

@endforelse


@endif

@endsection