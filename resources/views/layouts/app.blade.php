<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'DevOps Drops')
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-950 text-gray-100 font-[Poppins]">
    
    <header class="border-b border-gray-800 p-6">
        <div class="max-w-5xl mx-auto">
            <a href="/" class="text-2xl font-bold">
                DevOps Drops
            </a>
        </div>
    </header>

    <main class="max-w-5xl mx-auto p-6">
        @yield('content')
    </main>

    <footer class="border-t border-gray-800 p-6 mt-10">
        <div class="max-w-5xl mx-auto text-gray-400">
            © {{ date('Y') }} DevOps Drops
        </div>
    </footer>

</body>

</html>