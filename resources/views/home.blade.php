@extends('layouts.app')

@section('title', 'The DevOps Drop - DevOps, Cloud & Infrastructure')

@section('description', 'Practical DevOps tutorials covering cloud infrastructure, Linux, containers, automation and modern engineering practices.')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- Hero --}}
    <section class="py-20 text-center">

        <h1 class="text-6xl font-bold mb-6">
            {{config('app.name')}}
        </h1>

        <p class="text-xl text-gray-400 max-w-3xl mx-auto mb-8">
            Practical guides, tutorials, and insights covering DevOps,
            cloud infrastructure, automation, and modern engineering.
        </p>

        <x-button href="{{ route('articles.index') }}">
            Explore Articles
        </x-button>

    </section>


    {{-- Latest Articles --}}
    <section class="py-12">

        <h2 class="text-3xl font-bold mb-8">
            Latest Articles
        </h2>

        <div class="grid md:grid-cols-3 gap-8">

            @foreach($articles as $index => $article)
            <x-article-card 
                :article="$article"
                :priority="$index === 0"    
            />
            @endforeach

        </div>

    </section>


    {{-- Topics --}}
    <section class="py-12">

        <h2 class="text-3xl font-bold mb-6">
            Explore Topics
        </h2>

        <div class="flex flex-wrap gap-4">

            @foreach($topics as $topic)

            <x-tag class="px-5 py-2">
                {{ $topic->name }}
            </x-tag>

            @endforeach

        </div>

    </section>

</div>

@endsection