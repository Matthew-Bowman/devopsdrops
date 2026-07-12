@extends('layouts.app')

@section('title', 'Articles - DevOps Drops')

@section('content')

<h1 class="text-4xl font-bold mb-8">
    Articles
</h1>

<div class="grid gap-6">

@foreach($articles as $article)

<article class="bg-gray-900 p-6 rounded-lg">

<h2 class="text-2xl font-bold">
    <a href="{{ route('articles.show', $article) }}">
        {{ $article->title }}
    </a>
</h2>

<p class="text-gray-400 mt-3">
    {{ $article->excerpt }}
</p>

</article>

@endforeach

</div>

@endsection