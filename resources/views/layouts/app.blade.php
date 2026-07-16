<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', config('app.name'))</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/devopsdrops.svg">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <meta name="description" content="@yield('description', 'DevOps tutorials, guides and infrastructure articles.')">

    <meta property="og:title" content="@yield('og_title', config('app.name'))">
    <meta property="og:description" content="@yield('og_description', 'DevOps guides, tutorials, and infrastructure articles.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/default-og.png'))">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', config('app.name'))">
    <meta name="twitter:description" content="@yield('og_description', 'DevOps guides, tutorials, and infrastructure articles.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/default-og.png'))">

    <meta property="article:published_time" content="@yield('published_time')">

    <!-- Site JS & CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts Init -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Umami Analytics -->
    <script defer src="https://umami.devopsdrops.uk/script.js" data-website-id="9f831009-776a-4559-921f-143fca4220ec"></script>
</head>

<body class="bg-gray-950 text-gray-100 font-sans" x-data="{ encyclopediaOpen:false }">

    <header class="sticky top-0 z-50 border-b border-gray-800 bg-gray-950/80 backdrop-blur">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between gap-8">

            <a href="{{ route('home') }}"
                class="flex items-center gap-3 text-2xl font-bold tracking-tight text-white">

                <img
                    src="{{ asset('devopsdrops.svg') }}"
                    alt=""
                    class="h-8 w-8">

                <span>
                    {{ config('app.name') }}
                </span>

            </a>

            <!-- Navigation + Search -->
            <div class="hidden md:flex items-center gap-6 flex-1 justify-end">

                <nav class="flex items-center gap-6 text-gray-300">

                    <a href="{{ route('articles.index') }}"
                        class="{{ request()->is('articles*') ? 'text-white' : 'text-gray-300' }} hover:text-white transition">
                        Articles
                    </a>


                    <a href="{{ route('topics.index') }}"
                        class="{{ request()->is('topics*') ? 'text-white' : 'text-gray-300' }} hover:text-white transition">
                        Topics
                    </a>

                    <a href="{{ route('encyclopedia.index') }}"
                        class="{{ request()->is('topics*') ? 'text-white' : 'text-gray-300' }} hover:text-white transition">
                        Encyclopedia
                    </a>

                </nav>


                <!-- Search -->
                <form action="{{ route('search') }}" method="GET">

                    <div class="relative">

                        <input
                            type="search"
                            name="q"
                            placeholder="Search..."
                            class="w-48 rounded-lg border border-gray-700 bg-gray-900 px-4 py-2 text-sm text-white placeholder-gray-500 focus:border-blue-500 focus:outline-none">

                    </div>

                </form>

            </div>



            <!-- Mobile Menu -->
            <div id="mobile-menu"
                class="hidden md:hidden absolute top-full left-0 w-full bg-gray-900 border-t border-gray-700 shadow-2xl">


                <nav class="flex flex-col px-6 py-5 text-gray-300">

                    <a href="{{ route('articles.index') }}"
                        class="{{ request()->is('articles*') ? 'text-white' : 'text-gray-300' }} rounded-md px-3 py-2 hover:bg-gray-800 hover:text-white transition">
                        Articles
                    </a>

                    <a href="{{ route('topics.index') }}"
                        class="{{ request()->is('topics*') ? 'text-white' : 'text-gray-300' }} rounded-md px-3 py-2 hover:bg-gray-800 hover:text-white transition">
                        Topics
                    </a>

                    <a href="{{ route('encyclopedia.index') }}"
                        class="{{ request()->is('topics*') ? 'text-white' : 'text-gray-300' }} rounded-md px-3 py-2 hover:bg-gray-800 hover:text-white transition">
                        Encyclopedia
                    </a>

                    <!-- Mobile Search -->
                    <form action="{{ route('search') }}" method="GET" class="mt-4">

                        <div class="relative">
                            <input
                                type="search"
                                name="q"
                                placeholder="Search articles..."
                                class="w-full rounded-lg border border-gray-700 bg-gray-950 px-4 py-2 text-sm text-white placeholder-gray-500 focus:border-blue-500 focus:outline-none">
                        </div>

                    </form>

                </nav>


            </div>



            <!-- Mobile Button -->
            <button
                id="mobile-menu-button"
                class="md:hidden text-gray-300">
                ☰
            </button>


        </div>
    </header>

    <main class="max-w-5xl mx-auto p-6">

        @yield('breadcrumbs')

        @yield('content')

    </main>



    <footer class="border-t border-gray-800 bg-gray-950">

        <div class="max-w-5xl mx-auto p-6">

            <div class="grid grid-cols-1 gap-8 md:grid-cols-5">


                {{-- Brand --}}
                <div class="md:col-span-2">

                    <a href="{{ route('home') }}"
                        class="text-2xl font-bold tracking-tight text-white">
                        {{ config('app.name') }}
                    </a>


                    <p class="mt-3 max-w-md text-sm leading-6 text-gray-400">
                        Engineering-focused resources covering DevOps,
                        Linux, cloud infrastructure, networking,
                        automation, and modern software delivery practices.
                    </p>


                    <a href="{{ route('encyclopedia.index') }}"
                        class="
                        mt-5
                        inline-flex
                        items-center
                        text-sm
                        font-medium
                        text-indigo-400
                        transition
                        hover:text-indigo-300
                    ">
                        Explore Encyclopedia
                        <span class="ml-1">→</span>
                    </a>

                </div>



                {{-- Resources --}}
                <div class="flex-1">

                    <h3 class="text-xs font-semibold uppercase tracking-widest text-gray-500">
                        Resources
                    </h3>


                    <ul class="mt-4 space-y-2 text-sm text-gray-400">

                        <li>
                            <a href="{{ route('articles.index') }}"
                                class="transition hover:text-white">
                                Articles
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('encyclopedia.index') }}"
                                class="transition hover:text-white">
                                Encyclopedia
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('topics.index') }}"
                                class="transition hover:text-white">
                                Topics
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('search') }}"
                                class="transition hover:text-white">
                                Search
                            </a>
                        </li>

                    </ul>

                </div>



                {{-- Encyclopedia --}}
                <div class="flex-1">

                    <h3 class="text-xs font-semibold uppercase tracking-widest text-gray-500">
                        Encyclopedia
                    </h3>


                    <ul class="mt-4 space-y-2 text-sm text-gray-400">

                        @foreach($footerEntries ?? [] as $entry)

                        <li>
                            <a href="{{ route('encyclopedia.show', $entry) }}"
                                class="transition hover:text-white">

                                {{ $entry->title }}

                            </a>
                        </li>

                        @endforeach


                        <li class="pt-2">

                            <a href="{{ route('encyclopedia.index') }}"
                                class="
                                inline-flex
                                items-center
                                text-indigo-400
                                transition
                                hover:text-indigo-300
                            ">

                                Browse all entries
                                <span class="ml-1">→</span>

                            </a>

                        </li>

                    </ul>

                </div>



                {{-- Topics --}}
                <div class="flex-1">

                    <h3 class="text-xs font-semibold uppercase tracking-widest text-gray-500">
                        Topics
                    </h3>


                    <ul class="mt-4 space-y-2 text-sm text-gray-400">

                        @foreach($footerTopics ?? [] as $topic)

                        <li>

                            <a href="{{ route('topics.show', $topic) }}"
                                class="transition hover:text-white">

                                {{ $topic->name }}

                            </a>

                        </li>

                        @endforeach


                        <li class="pt-2">

                            <a href="{{ route('topics.index') }}"
                                class="
                                inline-flex
                                items-center
                                text-indigo-400
                                transition
                                hover:text-indigo-300
                            ">

                                View all topics
                                <span class="ml-1">→</span>

                            </a>

                        </li>

                    </ul>

                </div>

            </div>


        </div>



        {{-- Bottom --}}
        <div class="
            mt-10
            border-t
            border-gray-800
            py-4
            flex
            flex-col
            gap-3
            text-sm
            text-gray-500
            md:flex-row
            md:items-center
            md:justify-between
            max-w-5xl mx-auto p-6
        ">

            <p>
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>


            <p class="font-mono text-gray-600">
                built with curiosity & automation
            </p>



        </div>

    </footer>


    <div
        x-show="encyclopediaOpen"
        x-transition.opacity
        class="
    fixed
    inset-0
    z-50
    bg-black/50
    "
        @click="encyclopediaOpen=false">

    </div>


    <aside
        x-cloak
        x-show="encyclopediaOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"

        class="
    fixed
    top-0
    right-0
    z-50
    h-screen
    w-full
    max-w-md
    overflow-y-auto
    border-l
    border-gray-800
    bg-gray-950
    p-6
    ">

        <div class="flex items-center justify-between mb-6">

            <h2 class="text-xl font-bold text-white">
                Encyclopedia
            </h2>


            <button
                @click="encyclopediaOpen=false"
                class="
            text-gray-400
            hover:text-white
            text-xl
            ">
                ×
            </button>

        </div>


        <x-encyclopedia-tree
            :entries="$encyclopediaTree" />

    </aside>
    @if(request()->routeIs('encyclopedia.*'))
    <button
        @click="encyclopediaOpen = true"
        class="
    fixed
    bottom-6
    right-6
    rounded-full
    bg-indigo-600
    p-4
    shadow-lg
    hover:bg-indigo-500
    transition
    ">
        🌳
    </button>
    @endif
</body>

</html>