@extends('layouts.app')

@section('title', $entry->title . ' Subtopics')
@section('description', 'Explore concepts within ' . $entry->title)

@section('content')

<div class="max-w-7xl mx-auto">

    @section('breadcrumbs')

    <x-breadcrumbs :items="[
        [
            'label' => 'Home',
            'url' => route('home')
        ],
        [
            'label' => 'Encyclopedia',
            'url' => route('encyclopedia.index')
        ],
        [
            'label' => $entry->title,
            'url' => route('encyclopedia.show', $entry)
        ],
        [
            'label' => 'Subtopics'
        ]
    ]" />

    @endsection


    <section class="mb-12">

        <h1 class="text-5xl font-bold mb-4">
            {{ $entry->title }} Subtopics
        </h1>

        <p class="text-xl text-gray-400 max-w-3xl">
            Explore concepts and entries related to {{ $entry->title }}.
        </p>

    </section>


    @if($subtopics->count())

    <div class="
        grid
        gap-8
        md:grid-cols-2
        lg:grid-cols-3
    ">

        @foreach($subtopics as $subtopic)

        <a href="{{ route('encyclopedia.show', $subtopic) }}"
            class="
                group
                rounded-2xl
                border
                border-gray-800
                bg-gray-900
                p-8
                transition
                hover:border-indigo-500/50
                hover:-translate-y-1
            ">

            <h2 class="
                text-2xl
                font-bold
                mb-4
                group-hover:text-indigo-400
                transition
            ">
                {{ $subtopic->title }}
            </h2>

            @if($subtopic->excerpt)

            <p class="text-gray-400 leading-relaxed">
                {{ $subtopic->excerpt }}
            </p>

            @endif

        </a>

        @endforeach

    </div>

    {{ $subtopics->links() }}

    @else

    <div class="
        rounded-xl
        border
        border-gray-800
        bg-gray-900
        p-8
        text-gray-400
    ">
        No subtopics available.
    </div>

    @endif


</div>

@endsection