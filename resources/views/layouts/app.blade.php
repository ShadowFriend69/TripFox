<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Экскурсии</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
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
        <nav class="flex items-center gap-x-4">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-500">Главная</a>
            <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-500">О нас</a>

            @auth
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.away="open = false"
                            class="flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        {{ auth()->user()->name }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open"
                         class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-50"
                         x-transition>
                        <a href="admin" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Профиль</a>

                        <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                Выйти
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('filament.admin.auth.login') }}"
                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Войти
                </a>
            @endauth
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
