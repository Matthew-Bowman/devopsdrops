@props([
'article',
'priority' => false,
])

<article class="group relative flex flex-col bg-gray-900 rounded-xl overflow-hidden border border-gray-800 hover:border-blue-500 transition duration-300">

    @if($article->coverImage)
    <div>
        <img
            src="{{ $article->coverImage->url('M') }}"
            srcset="
                {{ $article->coverImage->url('S') }} 400w,
                {{ $article->coverImage->url('M') }} 800w
            "
            sizes="(max-width: 768px) 100vw, 33vw"
            alt="{{ $article->coverImage->alt_text ?? $article->title }}"
            width="800"
            height="450"
            @if($priority)
            fetchpriority="high"
            @else
            loading="lazy"
            @endif
            class="w-full aspect-video object-cover group-hover:scale-105 transition duration-300">
    </div>
    @endif

    <div class="p-6 grow flex flex-col">

        <h2 class="text-2xl font-bold mb-3">
            {{ $article->title }}
        </h2>

        <div class="flex flex-wrap gap-2 mb-4">
            @foreach($article->tags as $tag)
            <x-tag class="text-xs px-2 py-1 border border-gray-700 relative z-10">
                {{ $tag->name }}
            </x-tag>
            @endforeach
        </div>

        <p class="text-gray-400 mb-5 line-clamp-3">
            {{ $article->excerpt }}
        </p>

        <div class="mt-auto">

            <span class="inline-flex items-center gap-2 text-blue-400 font-medium group-hover:text-blue-300 transition mb-5">
                Read article
                <svg
                    class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </span>

            <div class="flex items-center justify-between text-sm text-gray-500">
                <span>
                    {{ $article->published_at->format('d M Y') }}
                </span>

                <span>
                    {{ $article->reading_time }} min read
                </span>
            </div>

        </div>

    </div>

    {{-- Makes the entire card clickable --}}
    <a
        href="{{ route('articles.show', $article) }}"
        class="absolute inset-0 z-0"
        aria-label="Read {{ $article->title }}">
    </a>

</article>