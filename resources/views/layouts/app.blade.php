<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Menambahkan tag audio untuk memutar musik background -->

</head>
<body class="bg-gray-200 min-h-screen flex flex-col">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-6 mt-8">
        <div class="container mx-auto text-center">
            <p class="text-lg">&copy; 2024 CATALYSM SOUND. All rights reserved.</p>
            <p class="text-sm">Rayhan Ahadi Nifri</p>
        </div>
    </footer>
</body>
</html>
