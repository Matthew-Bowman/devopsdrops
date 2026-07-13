@extends('layouts.app')

@section('title', $article->title)
@section('description', $article->excerpt)
@section('og_title', $article->title)
@section('og_description', $article->excerpt)
@section('og_type', 'article')
@section('og_image', url(Storage::url($article->coverImage->path)))
@section('published_time', $article->published_at->toISOString())

@section('content')

<script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "TechArticle",
        "headline": "{{ $article->title }}",
        "datePublished": "{{ $article->published_at }}",
        "author": {
            "@type": "Person",
            "name": "DevOps Drops"
        }
    }
</script>

<article>

    <h1 class="text-5xl font-bold mb-4">
        {{ $article->title }}
    </h1>

    <p class="text-gray-400 mb-8">
        Published {{ $article->published_at->format('d M Y') }} · {{ $article->reading_time }} min read
    </p>

    <img style="aspect-ratio: 16/9; object-fit: cover;" src="{{ Storage::url($article->coverImage->path) }}" alt="{{ $article->coverImage->alt_text }}">

    <div class="article-content max-w-none">
        {!! $article->content !!}
    </div>

</article>

@endsection