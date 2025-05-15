@extends('layouts.app')

@section('search')
    {{-- Здесь можно не выводить строку поиска, либо оставить --}}
    @include('partials.search', ['categories' => []])
@endsection

@section('content')
    <div class="container py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Изображение --}}
            <img src="{{ asset('storage/' . $excursion->detail_image) }}" alt="{{ $excursion->title }}" class="w-full h-96 object-cover rounded shadow">

            {{-- Информация об экскурсии --}}
            <div>
                <h1 class="text-3xl font-bold mb-4">{{ $excursion->title }}</h1>
                <p class="text-gray-700 mb-4">{{ $excursion->detail_text }}</p>

                <div class="mb-4">
                    <span class="font-semibold">Маршрут:</span> {{ $excursion->route }}
                </div>

                <div class="mb-4">
                    <span class="font-semibold">Стоимость:</span> {{ number_format($excursion->price, 0, ',', ' ') }} ₽
                </div>

                <div class="mb-4">
                    <span class="font-semibold">Гид:</span>
                    {{ $excursion->guide->name ?? 'Не указан' }}
                </div>

                <div>
                    @auth
                        <a href="#" class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Забронировать экскурсию
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block px-6 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            Войти для бронирования
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        {{-- Раздел с комментариями / отзывами --}}
{{--        <div class="mt-10">--}}
{{--            <h2 class="text-xl font-semibold mb-4">Отзывы клиентов</h2>--}}

{{--            --}}{{-- Пример вывода отзывов --}}
{{--            @forelse ($excursion->comments as $comment)--}}
{{--                <div class="border-b py-4">--}}
{{--                    <div class="text-sm text-gray-600 mb-1">--}}
{{--                        {{ $comment->user->name }} — {{ $comment->created_at->format('d.m.Y') }}--}}
{{--                    </div>--}}
{{--                    <div>{{ $comment->text }}</div>--}}
{{--                </div>--}}
{{--            @empty--}}
{{--                <p class="text-gray-500">Пока нет отзывов.</p>--}}
{{--            @endforelse--}}
{{--        </div>--}}
    </div>
@endsection
