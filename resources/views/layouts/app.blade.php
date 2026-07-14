<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', config('app.name'))</title>

    <meta name="description" content="@yield('description', 'DevOps tutorials, guides and infrastructure articles.')">

    <title>@yield('title', config('app.name'))</title>

    <meta name="description" content="@yield('description', 'DevOps guides, tutorials, and infrastructure articles.')">

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

    <!-- Tailwind Import -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Site JS -->
    @vite(['resources/js/app.js'])

    <!-- Google Fonts Init -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Umami Analytics -->
    <script defer src="https://umami.devopsdrops.uk/script.js" data-website-id="9f831009-776a-4559-921f-143fca4220ec"></script>
</head>

<body class="bg-gray-950 text-gray-100 font-[Poppins]">

    <header class="sticky top-0 z-50 border-b border-gray-800 bg-gray-950/80 backdrop-blur">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between gap-8">

            <!-- Logo -->
            <a href="/" class="text-2xl font-bold shrink-0">
                {{ config('app.name') }}
            </a>

            <!-- Navigation + Search -->
            <div class="hidden md:flex items-center gap-6 flex-1 justify-end">

                <nav class="flex items-center gap-6 text-gray-300">
                    <a href="/articles"
                        class="{{ request()->is('articles*') ? 'text-white' : 'text-gray-300' }} hover:text-white transition">
                        Articles
                    </a>
                </nav>

                <!-- Search -->
                <form action="/search" method="GET">
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

                    <a href="/articles"
                        class="{{ request()->is('articles*') ? 'text-white' : 'text-gray-300' }} rounded-md px-3 py-2 hover:bg-gray-800 hover:text-white transition">
                        Articles
                    </a>

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

    <footer class="border-t border-gray-800 p-6 mt-10">
        <div class="max-w-5xl mx-auto text-gray-400">
            © {{ date('Y') }} {{ config('app.name') }}
        </div>
    </footer>

</body>

</html>