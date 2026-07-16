<ul class="space-y-1">

    @foreach($entries as $item)

    @php
    $isCurrent = $currentEntry?->id === $item->id;
    $isAncestor = $currentEntry
    && $currentEntry->ancestors()->contains('id', $item->id);
    @endphp


    <li>

        <a href="{{ route('encyclopedia.show', $item) }}"
            class="
        block
        rounded-md
        px-2
        py-1
        text-sm
        transition

        {{ $isCurrent
            ? 'bg-indigo-500/20 text-indigo-300 font-semibold'
            : 'text-gray-400 hover:text-white'
        }}
        ">

            {{ $item->title }}

        </a>


        @if($item->childrenRecursive->count())

        <div class="
            ml-4
            mt-1
            border-l
            border-gray-800
            pl-3
            {{ $isAncestor || $isCurrent ? '' : 'hidden' }}
        ">

            <x-encyclopedia-tree
                :entries="$item->childrenRecursive"
                :current-entry="$currentEntry" />

        </div>

        @endif


    </li>

    @endforeach

</ul>