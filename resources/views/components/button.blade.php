<a {{ $attributes->merge([
    'class' => 'group relative inline-flex items-center gap-2 px-8 py-3 rounded-xl font-semibold text-white bg-blue-600 hover:bg-blue-700 transition-all duration-300'
]) }}>

    <span>{{ $slot }}</span>

    <svg
        class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 ">
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M13 7l5 5m0 0l-5 5m5-5H6" />
    </svg>

</a>