<!DOCTYPE html>
<html lang="ru">
<script src="//unpkg.com/alpinejs" defer></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Экскурсии</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow mb-6" x-data="{ menuOpen: false }">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        {{-- Лого --}}
        <h1 class="text-xl font-bold text-blue-600">
            <a href="{{ route('home') }}">TripFox</a>
        </h1>

        {{-- Иконка бургера --}}
        <button class="md:hidden text-gray-700 focus:outline-none" @click="menuOpen = !menuOpen">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        {{-- Поиск (если есть) --}}
        @hasSection('search')
            <div class="hidden md:block flex-1 mx-4">
                @yield('search')
            </div>
        @endif

        {{-- Навигация десктоп --}}
        <nav class="hidden md:flex items-center gap-x-4">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-500">Главная</a>
            <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-500">Контакты</a>

            @auth
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.away="open = false"
                            class="flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        {{ auth()->user()->name }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition
                         class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-50">
                        <a href="{{ route('filament.admin.pages.dashboard') }}"
                           class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Профиль</a>

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

    {{-- Мобильное меню --}}
    <div x-show="menuOpen" x-transition class="md:hidden px-4 pb-4">
        <nav class="space-y-2">
            <a href="{{ route('home') }}" class="block text-gray-700 hover:text-blue-500">Главная</a>
            <a href="{{ route('about') }}" class="block text-gray-700 hover:text-blue-500">Контакты</a>

            @auth
                <a href="{{ route('filament.admin.pages.dashboard') }}"
                   class="block text-gray-700 hover:text-blue-500">Профиль</a>
                <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left text-gray-700 hover:text-blue-500">Выйти</button>
                </form>
            @else
                <a href="{{ route('filament.admin.auth.login') }}"
                   class="block text-gray-700 hover:text-blue-500">Войти</a>
            @endauth
        </nav>

        {{-- Мобильный поиск, если есть --}}
        @hasSection('search')
            <div class="mt-4">
                @yield('search')
            </div>
        @endif
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
