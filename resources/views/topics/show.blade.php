@extends('layouts.app')

@section('title', $topic->seo_title ?? $topic->name . ' - ' . config('app.name'))

@section('description', $topic->seo_description ?? $topic->description)

@section('og_title', $topic->seo_title ?? $topic->name . ' - ' . config('app.name'))

@section('og_description', $topic->seo_description ?? $topic->description)

@section('og_type', 'website')


@section('content')

<div class="max-w-7xl mx-auto">

    @section('breadcrumbs')

    <x-breadcrumbs :items="[
    [
        'label' => 'Home',
        'url' => '/'
    ],
    [
        'label' => 'Topics',
        'url' => '/topics'
    ],
    [
        'label' => $topic->name
    ]
]" />

    @endsection

    <!-- Topic Header -->
    <section class="mb-12">

        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            {{ $topic->name }}
        </h1>


        <p class="text-lg text-gray-400 max-w-3xl leading-relaxed">
            {{ $topic->description }}
        </p>


    </section>



    <!-- Topic Introduction -->
    @if($topic->content)

    <section class="mb-12">

        <div class="
            prose 
            prose-invert 
            max-w-none
            prose-headings:text-white
            prose-p:text-gray-300
            prose-li:text-gray-300
        ">

            {!! $topic->content !!}

        </div>

    </section>

    @endif



    <!-- Articles -->
    <section>

        <div class="flex items-center justify-between mb-8">

            <h2 class="text-2xl font-bold">
                {{ $topic->name }} Articles
            </h2>


            <span class="text-gray-500 text-sm">
                {{ $articles->total() }} articles
            </span>

        </div>



        @if($articles->count())


        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">

            @foreach($articles as $article)

            <x-article-card :article="$article" />

            @endforeach

        </div>



        <div class="mt-10">

            {{ $articles->links() }}

        </div>



        @else

        <div class="
            rounded-xl
            border
            border-gray-800
            bg-gray-900
            p-8
            text-center
            text-gray-400
        ">

            No articles have been published for this topic yet.

        </div>

        @endif


    </section>



</div>


@endsection