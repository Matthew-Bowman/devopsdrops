@extends('layouts.app')

@section('title', $cheatsheet->title)

@section('description', $cheatsheet->alt_text ?? $cheatsheet->title)

@section('og_title', $cheatsheet->title)

@section('og_description', $cheatsheet->alt_text ?? $cheatsheet->title)

@section('og_type', 'article')

@section('og_image', url($cheatsheet->url('N')))


@section('content')


<article>


    @section('breadcrumbs')

    <x-breadcrumbs :items="[
    [
        'label' => 'Home',
        'url' => '/'
    ],
    [
        'label' => 'Cheatsheets',
        'url' => route('cheatsheets.index')
    ],
    [
        'label' => ucfirst($topic),
        'url' => route('cheatsheets.show', $topic)
    ],
    [
        'label' => $cheatsheet->title
    ]
]" />

    @endsection



    <h1 class="text-5xl font-bold mb-4">
        {{ $cheatsheet->title }}
    </h1>



    @can('update', $cheatsheet)

    <div class="mb-6">

        <a href="{{ route('filament.admin.resources.media.edit', $cheatsheet) }}"
            class="
inline-flex
items-center
rounded-lg
border
border-gray-700
bg-gray-900
px-4
py-2
text-sm
text-gray-300
hover:text-white
hover:border-gray-500
transition">

            Edit Cheatsheet

        </a>

    </div>

    @endcan



    <p class="text-xl text-gray-400 leading-relaxed max-w-3xl mb-8">
        {{ $cheatsheet->alt_text }}
    </p>



    <!-- <div class="flex flex-wrap gap-2 mb-8">

        @foreach($cheatsheet->tags as $tag)

        <x-tag>
            {{ $tag }}
        </x-tag>

        @endforeach

    </div> -->



    <div
        x-data="{ open: false }"
        class="rounded-xl overflow-hidden border border-gray-800 bg-gray-900">

        <img
            src="{{ $cheatsheet->url('N') }}"
            alt="{{ $cheatsheet->alt_text }}"
            class="w-full cursor-zoom-in"
            @click="open = true">


        <!-- Lightbox -->
        <div
            x-show="open"
            x-effect="document.body.style.overflow = open ? 'hidden' : ''"
            x-transition
            @keydown.escape.window="open = false"
            @click.self="open = false"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-6"
            style="display: none;">

            <button
                @click="open = false"
                class="absolute top-5 right-5 flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-3xl text-white hover:bg-white/20 transition"
                aria-label="Close image preview">
                &times;
            </button>


            <img
                loading="lazy"
                src="{{ $cheatsheet->url('N') }}"
                alt="{{ $cheatsheet->alt_text }}"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                class="max-w-[85vw] max-h-[85vh] object-contain rounded-lg shadow-2xl">

        </div>

    </div>



    <section class="mt-12 border-t border-gray-800 pt-10">

        <h2 class="text-3xl font-bold mb-4">
            More {{ ucfirst($topic) }} Cheatsheets
        </h2>


        <div class="grid md:grid-cols-3 gap-8">


            @foreach($relatedCheatsheets as $related)

            @if($related->id !== $cheatsheet->id)

            @php

            $slug = collect($related->tags)
            ->first(fn($tag)=>str_starts_with($tag,'slug:'));

            $slug = str_replace('slug:','',$slug);

            @endphp


            <a href="{{ route('cheatsheets.view',[
    'topic'=>$topic,
    'slug'=>$slug
]) }}"
                class="group">


                <div class="rounded-xl overflow-hidden border border-gray-800 bg-gray-900">


                    <img
                        src="{{ $related->url('M') }}"
                        alt="{{ $related->alt_text }}"
                        class="aspect-video object-cover group-hover:scale-105 transition">


                    <div class="p-4">

                        <h3 class="font-bold">
                            {{ $related->title }}
                        </h3>

                    </div>


                </div>


            </a>


            @endif


            @endforeach


        </div>


    </section>



</article>


@endsection