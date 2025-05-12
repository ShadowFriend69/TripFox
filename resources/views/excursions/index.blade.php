@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="text-2xl font-bold mb-4">Экскурсии</h1>

        <form method="GET" class="mb-4">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск..." class="border px-2 py-1 mr-2">
            <select name="category" class="border px-2 py-1 mr-2">
                <option value="">Все категории</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
            <button class="bg-blue-500 text-white px-4 py-1">Найти</button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($excursions as $excursion)
                <div class="border rounded p-2 shadow">
                    <img src="{{ asset('storage/' . $excursion->preview_image) }}" alt="" class="mb-2 w-full h-48 object-cover">
                    <h2 class="text-lg font-semibold">{{ $excursion->title }}</h2>
                    <p class="text-sm text-gray-600 mb-2">{{ $excursion->preview_text }}</p>
{{--                    <a href="{{ route('excursions.show', $excursion->slug) }}" class="text-blue-500">Подробнее</a>--}}
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $excursions->withQueryString()->links() }}
        </div>
    </div>
@endsection
