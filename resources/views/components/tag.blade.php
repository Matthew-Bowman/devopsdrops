<a href="{{ $href ?? '#' }}"
    {{ $attributes->merge([
       'class' => 'text-sm bg-gray-800 hover:bg-gray-700 text-gray-300 px-3 py-1 rounded-md transition'
   ]) }}>
    {{ $slot }}
</a>