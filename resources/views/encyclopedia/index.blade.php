@extends('layouts.app')

@section('title', 'DevOps Encyclopedia - ' . config('app.name'))

@section('description', 'A reference library covering DevOps, infrastructure, networking, cloud, and software engineering concepts.')

@section('content')

<div class="max-w-7xl mx-auto">

    @section('breadcrumbs')

    <x-breadcrumbs :items="[
        [
            'label' => 'Home',
            'url' => route('home')
        ],
        [
            'label' => 'Encyclopedia'
        ]
    ]" />

    @endsection


    {{-- Hero --}}
    <section class="mb-14">

        <div class="
            rounded-2xl
            border
            border-gray-800
            bg-gray-900
            p-8
            mb-4
        ">

            <h1 class="text-2xl md:text-5xl font-bold mb-5">
                DevOps Encyclopedia
            </h1>

            <p class="
                text-xl
                text-gray-400
                leading-relaxed
                max-w-3xl
            ">
                A technical reference library covering the tools, concepts,
                protocols, and systems that power modern infrastructure.
            </p>


        </div>

    </section>

    {{-- Topics --}}

    <section class="mb-16">

        <div class="mb-8">

            <h2 class="text-3xl font-bold mb-2">
                Explore Topics
            </h2>

            <p class="text-gray-400">
                Browse concepts grouped by technology and domain.
            </p>

        </div>


        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">

            @foreach($topics as $topic)

            <a href="{{ route('encyclopedia.topic.show', $topic) }}"
                class="
            group
            flex flex-col
            relative
            overflow-hidden
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
            absolute
            inset-x-0
            top-0
            h-1
            bg-gradient-to-r
            from-indigo-500
            to-purple-500
            opacity-0
            group-hover:opacity-100
            transition
        "></div>


                <div class="flex items-center justify-between mb-6">

                    <div class="
                flex
                h-12
                w-12
                items-center
                justify-center
                rounded-xl
                bg-indigo-500/10
                text-indigo-400
                text-xl
                font-bold
            ">
                        #
                    </div>


                    <span class="
                rounded-full
                bg-gray-800
                px-3
                py-1
                text-xs
                text-gray-400
            ">
                        {{ $topic->entries_count }} entries
                    </span>

                </div>


                <h3 class="
            text-2xl
            font-bold
            text-white
            mb-3
            group-hover:text-indigo-400
            transition
        ">
                    {{ $topic->name }}
                </h3>


                <p class="
            text-gray-400
            leading-relaxed
            min-h-[3rem]
            mb-4
        ">
                    {{ $topic->description ?? 'Explore concepts, technologies, and reference material.' }}
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
        group-hover:border-indigo-400/50
    ">

                        <span>
                            Browse topic
                        </span>

                        <span class="
            transition-transform
            duration-300
            group-hover:translate-x-1
        ">
                            →
                        </span>

                    </div>

                </div>

            </a>

            @endforeach

        </div>

    </section>


    {{-- Latest Entries --}}

    @if($recentEntries->count())

    <section class="pt-12">


        <div class="mb-8">

            <h2 class="text-3xl font-bold mb-2">
                Latest Entries
            </h2>

            <p class="text-gray-400">
                Recently added concepts to the encyclopedia.
            </p>

        </div>


        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">


            @foreach($recentEntries as $entry)

            <a href="{{ route('encyclopedia.show', $entry) }}"
                class="
                    group
                    flex flex-col
                    rounded-xl
                    border
                    border-gray-800
                    bg-gray-900/40
                    p-6
                    hover:border-gray-600
                    transition
                ">


                <div class="text-sm text-gray-500 mb-4">

                    @if($entry->topic)
                    {{ $entry->topic->name }}
                    @endif

                    @if($entry->entryType)

                    · {{ $entry->entryType->name }}

                    @endif

                </div>


                <h3 class="
                    text-xl
                    font-semibold
                    mb-3
                    group-hover:text-indigo-400
                    transition
                ">
                    {{ $entry->title }}
                </h3>


                <p class="text-gray-400 leading-relaxed mb-4">
                    {{ $entry->excerpt }}
                </p>


                <div class="
                    mt-auto
                    text-sm
                    text-indigo-400
                ">
                    Read entry →
                </div>


            </a>


            @endforeach


        </div>


    </section>

    @endif


</div>

@endsection