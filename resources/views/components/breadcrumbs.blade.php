@if(count($items))

<div class="mb-6 text-sm text-gray-500">

    @foreach($items as $index => $item)

    @if($index > 0)

    <span class="mx-2">
        /
    </span>

    @endif


    @if(isset($item['url']))

    <a href="{{ $item['url'] }}"
        class="hover:text-white transition">
        {{ $item['label'] }}
    </a>

    @else

    <span class="text-gray-400">
        {{ $item['label'] }}
    </span>

    @endif


    @endforeach

</div>

@endif