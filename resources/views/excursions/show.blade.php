@extends('layouts.app')

@section('search')
    {{-- строка поиска --}}
    @include('partials.search', ['categories' => []])
@endsection

@section('content')
    {{-- оборачиваем всё в x-data, чтобы переменная bookingOpen была видна и кнопке, и модалке --}}
    <div x-data="{ bookingOpen: false }" class="container py-8 space-y-8">
        {{-- Верхний блок --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
            {{-- Изображение --}}
            <img src="{{ asset('storage/' . $excursion->detail_image) }}" alt="{{ $excursion->title }}" class="w-full h-96 object-cover rounded shadow">

            {{-- Название и краткое описание --}}
            <div>
                <h1 class="text-3xl font-bold mb-4">{{ $excursion->title }}</h1>
                <div class="text-gray-600 prose max-w-none">{!! $excursion->preview_text !!}</div>
            </div>
        </div>

        {{-- Подробности --}}
        <div class="space-y-4">
            <div class="text-gray-700 prose max-w-none">{!! $excursion->detail_text !!}</div>

            <div>
                <span class="font-semibold">Маршрут:</span> {{ implode(', ', $excursion->locations) }}
            </div>

            <div>
                <span class="font-semibold">Стоимость:</span> {{ number_format($excursion->price, 0, ',', ' ') }} ₽
            </div>

            <div>
                <span class="font-semibold">Гид:</span>
                {{ $excursion->guide->name ?? 'Не указан' }}
            </div>

            <div class="mt-6">
                @auth
                    <button
                            @click="bookingOpen = true"
                            class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    >
                        Забронировать экскурсию
                    </button>
                @else
                    <a href="{{ route('filament.admin.auth.login') }}"
                       class="inline-block px-6 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        Войти для бронирования
                    </a>
                @endauth
            </div>
        </div>

        {{-- Модалка бронирования --}}
        @auth
            <div
                    x-show="bookingOpen"
                    x-transition
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
                <div @click.away="bookingOpen = false"
                     class="bg-white p-6 rounded shadow-lg w-full max-w-md">

                    <h2 class="text-xl font-bold mb-4">Забронировать экскурсию</h2>

                    <form action="{{ route('excursions.book', $excursion) }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700">Дата экскурсии</label>
                            <input type="date" name="date" required class="form-input mt-1 block w-full" min="{{ now()->format('Y-m-d') }}">
                        </div>

                        <div>
                            <label for="people_count" class="block text-sm font-medium text-gray-700">Количество человек</label>
                            <input type="number" name="people_count" value="1" min="1" max="{{ $excursion->max_people }}" class="form-input mt-1 block w-full">
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="button" @click="bookingOpen = false"
                                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                Отмена
                            </button>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Забронировать
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endauth
    </div>
@endsection
