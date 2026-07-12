@extends('layouts.app')

@section('title', $article->title)

@section('content')

<article>

<h1 class="text-5xl font-bold mb-4">
    {{ $article->title }}
</h1>

<p class="text-gray-400 mb-8">
    Published {{ $article->published_at->format('d M Y') }}
</p>

@if($article->cover_image)
<img 
    src="/storage/{{ $article->cover_image }}"
    class="rounded-lg mb-8"
>
@endif

<div class="prose prose-invert max-w-none">
    {!! $article->content !!}
</div>

</article>

@endsection