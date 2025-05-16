@extends('layouts.app')

@section('search')
    {{-- строка поиска --}}
    @include('partials.search', ['categories' => []])
@endsection

@section('content')
    <div class="container py-8 space-y-8">
        {{-- Верхний блок: изображение слева, заголовок и preview_text справа --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
            {{-- Изображение --}}
            <img src="{{ asset('storage/' . $excursion->detail_image) }}" alt="{{ $excursion->title }}" class="w-full h-96 object-cover rounded shadow">

            {{-- Название и краткое описание --}}
            <div>
                <h1 class="text-3xl font-bold mb-4">{{ $excursion->title }}</h1>
                <div class="text-gray-600 prose max-w-none">{!! $excursion->preview_text !!}</div>
            </div>
        </div>

        {{-- Остальная информация: на всю ширину --}}
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

            <div>
                Для бронирования и других вопросов, обращайтесь к нам:

                <a href="{{ route('about') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Контакты
                </a>
            </div>

{{--            <div>--}}
{{--                @auth--}}
{{--                    <a href="#" class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">--}}
{{--                        Забронировать экскурсию--}}
{{--                    </a>--}}
{{--                @else--}}
{{--                    <a href="{{ route('filament.admin.auth.login') }}" class="inline-block px-6 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">--}}
{{--                        Войти для бронирования--}}
{{--                    </a>--}}
{{--                @endauth--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
