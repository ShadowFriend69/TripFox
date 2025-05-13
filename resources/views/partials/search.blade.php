<form method="GET" action="{{ route('home') }}" class="flex items-center space-x-2">
    <input
            type="text"
            name="q"
            value="{{ request('q') }}"
            placeholder="Поиск..."
            class="border px-2 py-1 rounded text-sm"
    >
    <button class="bg-blue-500 text-white px-4 py-1 rounded text-sm">Найти</button>
</form>
