<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Экскурсии</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow mb-6">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-600">
            <a href="{{ route('home') }}">TripFox</a>
        </h1>
        @hasSection('search')
            @yield('search')
        @endif
        <nav>
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-500 px-2">Главная</a>
            <a href="{{ route('filament.admin.auth.login') }}" class="ml-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Войти
            </a>
        </nav>
    </div>
</header>

<main class="container mx-auto px-4">
    @yield('content')
</main>

<footer class="bg-white mt-12 py-4 border-t">
    <div class="container mx-auto text-center text-sm text-gray-500">
        &copy; {{ now()->year }} TripFox. Все права защищены.
    </div>
</footer>

</body>
</html>
