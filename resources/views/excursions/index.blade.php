@extends('layouts.app')

@section('search')
    @include('partials.search', ['categories' => $categories])
@endsection

@section('content')
    <div class="container py-4">
        <h1 class="text-2xl font-bold mb-4">Экскурсии</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($excursions as $excursion)
                <div class="border rounded p-2 shadow">
                    <img src="{{ asset('storage/' . $excursion->preview_image) }}" alt="" class="mb-2 w-full h-48 object-cover">
                    <h2 class="text-lg font-semibold">{{ $excursion->title }}</h2>
                    <p class="text-sm text-gray-600 mb-2">{{ $excursion->preview_text }}</p>
                    <a href="{{ route('excursion.show', $excursion->slug) }}" class="text-blue-500">Подробнее</a>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $excursions->withQueryString()->links() }}
        </div>
    </div>
@endsection
