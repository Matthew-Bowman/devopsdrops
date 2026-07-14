@extends('layouts.app')

@section('title', $article->title)
@section('description', $article->excerpt)
@section('og_title', $article->title)
@section('og_description', $article->excerpt)
@section('og_type', 'article')
@section('og_image', url(Storage::url($article->coverImage->path)))
@section('published_time', $article->published_at->toISOString())

@section('content')

<!-- Article Styling -->
<style>
    .article-content h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .article-content h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }

    .article-content p {
        margin-bottom: 1rem;
        line-height: 1.8;
        color: #d1d5db;
    }

    .article-content ul,
    .article-content ol {
        margin: 1rem 0;
        padding-left: 2rem;
    }

    .article-content li {
        margin-bottom: .5rem;
    }

    /* Inline code */
    .article-content :not(pre)>code {
        background: #1f2937;
        padding: .2rem .4rem;
        border-radius: .25rem;
        font-size: .9em;
    }

    /* Prism code blocks */
    .article-content pre[class*="language-"] {
        background: #111827;
        border-radius: .5rem;
        overflow-x: auto;
        margin: 1rem 0;
    }

    /* Reset inline styles only for block code */
    .article-content pre code {
        background: transparent;
        border-radius: 0;
        font-size: inherit;
    }
</style>

<script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "TechArticle",
        "headline": "{{ $article->title }}",
        "datePublished": "{{ $article->published_at }}",
        "author": {
            "@type": "Person",
            "name": "{{ config('app.name') }}"
        }
    }
</script>

<article>

    <h1 class="text-5xl font-bold mb-4">
        {{ $article->title }}
    </h1>

    <p class="text-xl text-gray-400 leading-relaxed max-w-3xl mb-6">
        {{ $article->excerpt }}
    </p>

    <p class="text-gray-400 mb-8">
        Published {{ $article->published_at->format('d M Y') }} · {{ $article->reading_time }} min read
    </p>

    <div class="flex flex-wrap gap-2 mb-4">

        @foreach($article->tags as $tag)

        <x-tag>
            {{ $tag->name }}
        </x-tag>

        @endforeach

    </div>

    <img style="aspect-ratio: 16/9; object-fit: cover;" src="{{ Storage::url($article->coverImage->path) }}" alt="{{ $article->coverImage->alt_text }}">

    <div class="article-content max-w-none">
        {!! $article->content !!}
    </div>

    @if($relatedArticles->count())

    <section class="mt-20 border-t border-gray-800 pt-12">

        <div class="rounded-xl bg-gray-900/40 border border-gray-800 p-8">

            <h2 class="text-3xl font-bold mb-2">
                Related Articles
            </h2>

            <p class="text-gray-400 mb-8">
                Continue exploring similar topics and guides.
            </p>

            <div class="grid md:grid-cols-3 gap-8">

                @foreach($relatedArticles as $relatedArticle)

                <x-article-card :article="$relatedArticle" />

                @endforeach

            </div>

        </div>

    </section>

    @endif

</article>

@endsection