@extends('layouts.app')

@section('title', $topic->name . ' Encyclopedia')
@section('description', $topic->description)

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
            'label' => $topic->name
        ]
    ]" />

    @endsection


    {{-- Header --}}

    <section class="mb-14">

        <div class="
            rounded-2xl
            border
            border-gray-800
            bg-gray-900
            p-8
            mb-4
        ">

            <div class="flex items-center gap-3 mb-5">

                <span class="text-sm text-gray-500">
                    {{ $entries->count() }} entries
                </span>

            </div>


            <h1 class="text-2xl md:text-5xl font-bold mb-5">
                {{ $topic->name }}
            </h1>


            @if($topic->description)

            <p class="
                max-w-3xl
                text-xl
                text-gray-400
                leading-relaxed
            ">
                {{ $topic->description }}
            </p>

            @endif


        </div>

    </section>



    {{-- Entries --}}

    <section>

        <div class="mb-8">

            <h2 class="text-3xl font-bold mb-2">
                Entries
            </h2>

            <p class="text-gray-400">
                Explore concepts and reference material related to {{ $topic->name }}.
            </p>

        </div>



        @if($entries->count())


        <div class="
            grid
            gap-8
            md:grid-cols-2
            lg:grid-cols-3
        ">


            @foreach($entries as $entry)


            <a href="{{ route('encyclopedia.show', $entry) }}"
                class="
                    group
                    flex flex-col
                    rounded-2xl
                    border
                    border-gray-800
                    bg-gray-900
                    p-8
                    transition-all
                    duration-300
                    hover:border-indigo-500/50
                    hover:-translate-y-1
                ">


                <div class="
                    flex
                    items-center
                    gap-2
                    text-sm
                    text-gray-500
                    mb-5
                ">

                    @if($entry->entryType)

                    <span class="
                        rounded-full
                        bg-gray-800
                        px-3
                        py-1
                    ">
                        {{ $entry->entryType->name }}
                    </span>

                    @endif

                </div>


                <h3 class="
                    text-2xl
                    font-bold
                    mb-4
                    group-hover:text-indigo-400
                    transition
                ">
                    {{ $entry->title }}
                </h3>


                <p class="
                    text-gray-400
                    leading-relaxed
                    mb-8
                ">
                    {{ $entry->excerpt }}
                </p>


                <div class="mt-auto">

                    <div class="
                        inline-flex
                        items-center
                        gap-3
                        rounded-full
                        border
                        border-indigo-500/30
                        bg-indigo-500/10
                        px-4
                        py-2
                        text-sm
                        font-medium
                        text-indigo-400
                        transition
                        group-hover:bg-indigo-500/20
                    ">

                        <span>
                            Read entry
                        </span>

                        <span class="
                            transition-transform
                            group-hover:translate-x-1
                        ">
                            →
                        </span>

                    </div>

                </div>


            </a>


            @endforeach


        </div>


        @else


        <div class="
            rounded-xl
            border
            border-gray-800
            bg-gray-900
            p-8
            text-gray-400
        ">
            No entries have been published for this topic yet.
        </div>


        @endif


    </section>


</div>

@endsection