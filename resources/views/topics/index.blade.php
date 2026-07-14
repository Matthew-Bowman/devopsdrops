@extends('layouts.app')


@section('title', 'Topics - ' . config('app.name'))

@section('description', 'Explore ' . config("app.name") . ' topics covering DevOps, cloud infrastructure, Linux, networking, containers, Kubernetes, automation, and more.')


@section('breadcrumbs')

<x-breadcrumbs :items="[
    [
        'label' => 'Home',
        'url' => route('home')
    ],
    [
        'label' => 'Topics'
    ]
]" />

@endsection



@section('content')

<div class="max-w-7xl mx-auto">


    <div class="mb-10">

        <h1 class="text-4xl font-bold mb-3">
            Topics
        </h1>


        <p class="text-gray-400 max-w-3xl">
            Explore {{ config("app.name") }} topics covering cloud infrastructure,
            Linux, networking, containers, Kubernetes, automation,
            and modern engineering practices.
        </p>

    </div>



    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">


        @foreach($topics as $topic)


        <a href="{{ route('topics.show', $topic) }}"
            class="
                    group
                    rounded-xl
                    overflow-hidden
                    border
                    border-gray-800
                    bg-gray-900
                    hover:border-gray-700
                    transition
               ">


            @if($topic->coverImage)

            <img
                src="{{ Storage::url($topic->coverImage->path) }}"
                alt="{{ $topic->name }}"
                class="w-full h-48 object-cover" />

            @else

            <div class="
                        h-48
                        bg-gray-800
                        flex
                        items-center
                        justify-center
                        text-gray-600
                    ">

                No image

            </div>

            @endif



            <div class="p-6">


                <h2 class="
                        text-2xl
                        font-semibold
                        mb-2
                        group-hover:text-white
                    ">

                    {{ $topic->name }}

                </h2>



                <p class="
                        text-gray-400
                        text-sm
                        mb-4
                    ">

                    {{ $topic->description }}

                </p>



                <div class="text-sm text-gray-500">

                    {{ $topic->articles_count }}
                    {{ Str::plural('article', $topic->articles_count) }}

                </div>


            </div>


        </a>


        @endforeach


    </div>


</div>

@endsection