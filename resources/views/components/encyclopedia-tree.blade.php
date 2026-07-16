<ul class="space-y-2">

    @foreach($entries as $entry)

    <li>

        <a href="{{ route('encyclopedia.show', $entry->slug) }}"
            class="
                    block
                    text-sm
                    text-gray-400
                    hover:text-white
                    transition
                    {{ request()->is('encyclopedia/'.$entry->slug) ? 'text-indigo-400 font-semibold' : '' }}
                ">

            {{ $entry->title }}

        </a>


        @if($entry->childrenRecursive->count())

        <div class="ml-4 mt-2 border-l border-gray-800 pl-4">

            <x-encyclopedia-tree
                :entries="$entry->childrenRecursive" />

        </div>

        @endif

    </li>

    @endforeach

</ul>