@php

$slug = collect($cheatsheet->tags)
->first(fn($tag)=>str_starts_with($tag,'slug:'));

$slug = str_replace('slug:','',$slug);

@endphp


<a href="{{ route('cheatsheets.view',[
    'topic'=>$topic,
    'slug'=>$slug
]) }}"
    class="group">


    <div class="
rounded-xl
overflow-hidden
border
border-gray-800
bg-gray-900/40
hover:border-blue-500
transition">


        <img
            src="{{ $cheatsheet->url('M') }}"
            alt="{{ $cheatsheet->alt_text }}"
            class="
w-full
aspect-video
object-cover
group-hover:scale-105
transition">


        <div class="p-5">

            <h3 class="text-xl font-bold">
                {{ $cheatsheet->title }}
            </h3>


        </div>

    </div>


</a>