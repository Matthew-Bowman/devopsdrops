@extends('layouts.app')


@section('title', Str::headline($topic).' Cheatsheets')
@section('description',
'Developer cheatsheets covering '.Str::headline($topic)
)


@section('content')


@section('breadcrumbs')

<x-breadcrumbs :items="[
[
'label'=>'Home',
'url'=>'/'
],
[
'label'=>'Cheatsheets',
'url'=>route('cheatsheets.index')
],
[
'label'=>Str::headline($topic)
]
]" />

@endsection



<h1 class="text-5xl font-bold mb-5">
    {{ Str::headline($topic) }} Cheatsheets
</h1>


<p class="text-xl text-gray-400 mb-10">
    Quick reference guides and visual documentation.
</p>



<div class="grid md:grid-cols-3 gap-8">


    @foreach($cheatsheets as $cheatsheet)

    <x-cheatsheet-card
        :cheatsheet="$cheatsheet"
        :topic="$topic" />

    @endforeach


</div>


@endsection