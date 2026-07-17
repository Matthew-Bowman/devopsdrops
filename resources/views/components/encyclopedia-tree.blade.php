<ul class="space-y-1">

    @foreach($entries as $entry)

    @php
    $isActive = isset($activePath) && $activePath->contains($entry->id);
    @endphp

    <li
        x-data="{ open: {{ $isActive ? 'true' : 'false' }} }">

        <div class="flex items-center gap-2">

            @if($entry->childrenRecursive->count())

            <button
                @click="open = !open"
                class="flex h-5 w-5 items-center justify-center text-gray-500 transition hover:text-indigo-400">

                <svg
                    class="h-3.5 w-3.5 transition-transform duration-200"
                    :class="open ? 'rotate-90' : ''"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7" />

                </svg>

            </button>

            @else

            <span class="w-5"></span>

            @endif


            <a href="{{ route('encyclopedia.show', $entry->slug) }}"
                class="
                    block
                    text-sm
                    transition
                    hover:text-white

                    {{ $isActive
                        ? 'text-indigo-400 font-semibold'
                        : 'text-gray-400'
                    }}
                ">

                {{ $entry->title }}

            </a>

        </div>


        @if($entry->childrenRecursive->count())

        <div
            x-cloak
            x-show="open"
            x-collapse.duration.300ms
            class="ml-5 mt-1 border-l {{ $isActive ? 'border-indigo-500' : 'border-gray-800' }} pl-3">

            <x-encyclopedia-tree
                :entries="$entry->childrenRecursive"
                :activePath="$activePath" />

        </div>

        @endif

    </li>

    @endforeach

</ul>