<ul class="space-y-1">

    @foreach($topics as $topic)

    @php
    $topicActive = $topic->entries
    ->pluck('id')
    ->intersect($activePath ?? collect())
    ->count() > 0;
    @endphp

    <li x-data="{ open: {{ $topicActive ? 'true' : 'false' }} }">

        <div class="flex items-center gap-2">

            @if($topic->entries->count())

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


            <a href="{{ route('encyclopedia.topic.show', $topic) }}"
                class="
                block
                text-sm
                transition
                hover:text-white
                {{ $topicActive
                    ? 'text-indigo-400 font-semibold'
                    : 'text-gray-400'
                }}
            ">

                {{ $topic->name }}

            </a>

        </div>


        @if($topic->entries->count())

        <div
            x-cloak
            x-show="open"
            x-collapse.duration.300ms
            class="ml-5 mt-1 border-l {{ $topicActive ? 'border-indigo-500' : 'border-gray-800' }} pl-3">

            <x-encyclopedia-tree
                :entries="$topic->entries"
                :activePath="$activePath" />

        </div>

        @endif

    </li>

    @endforeach

</ul>