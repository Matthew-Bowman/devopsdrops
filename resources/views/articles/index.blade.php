@extends('layouts.app')

@section('title', "Articles - " . config('app.name'))

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
        <x-article-card :article="$article" />
        @endforeach

    </div>

</div>

@endsection