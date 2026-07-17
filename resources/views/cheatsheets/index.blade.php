@extends('layouts.app')


@section('title', 'Developer Cheatsheets')
@section('description', 'Free programming and DevOps cheatsheets.')


@section('content')

@section('breadcrumbs')

<x-breadcrumbs :items="[
    [
        'label'=>'Home',
        'url'=>'/'
    ],
    [
        'label'=>'Cheatsheets'
    ]
]" />

@endsection


<h1 class="text-5xl font-bold mb-6">
    Developer Cheatsheets
</h1>


<p class="text-xl text-gray-400 mb-10 max-w-3xl">
    Quick reference guides for developers, DevOps engineers, and system administrators.
</p>



<div class="grid md:grid-cols-3 gap-8">


    @foreach($topics as $topic)

    <a href="{{ route('cheatsheets.show',$topic) }}"
        class="
group
rounded-xl
border
border-gray-800
bg-gray-900/40
p-8
hover:border-blue-500
transition">


        <h2 class="text-2xl font-bold mb-3">
            {{ Str::headline($topic) }}
        </h2>


        <p class="text-gray-400">
            Explore {{ Str::headline($topic) }} cheatsheets.
        </p>


    </a>


    @endforeach


</div>


@endsection