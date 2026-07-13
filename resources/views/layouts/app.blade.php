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

    <!-- Article Styling -->
    <style>
        .article-content h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .article-content h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .article-content p {
            margin-bottom: 1rem;
            line-height: 1.8;
            color: #d1d5db;
        }

        .article-content ul,
        .article-content ol {
            margin: 1rem 0;
            padding-left: 2rem;
        }

        .article-content li {
            margin-bottom: .5rem;
        }

        .article-content code {
            background: #1f2937;
            padding: .2rem .4rem;
            border-radius: .25rem;
        }

        .article-content pre {
            background: #111827;
            padding: 1rem;
            border-radius: .5rem;
            overflow-x: auto;
            margin: 1rem 0;
        }
    </style>

    <!-- Google Fonts Init -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Umami Analytics -->
    <script defer src="https://umami.devopsdrops.uk/script.js" data-website-id="9f831009-776a-4559-921f-143fca4220ec"></script>
</head>

<body class="bg-gray-950 text-gray-100 font-[Poppins]">

    <header class="border-b border-gray-800 p-6">
        <div class="max-w-5xl mx-auto">
            <a href="/" class="text-2xl font-bold">
                {{ config('app.name') }}
            </a>
        </div>
    </header>

    <main class="max-w-5xl mx-auto p-6">
        @yield('content')
    </main>

    <footer class="border-t border-gray-800 p-6 mt-10">
        <div class="max-w-5xl mx-auto text-gray-400">
            © {{ date('Y') }} {{ config('app.name') }}
        </div>
    </footer>

</body>

</html>