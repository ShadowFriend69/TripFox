@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded shadow max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold mb-6 text-blue-600">О нас</h2>
        <p class="mb-4 text-gray-700">
            TripFox — ваш надёжный помощник в мире экскурсий. Мы предлагаем лучшие маршруты, профессиональных гидов и незабываемые впечатления.
        </p>

        <h3 class="text-xl font-semibold mb-2 text-gray-800">Контакты</h3>
        <ul class="space-y-3 text-gray-700">
            <li class="flex items-center">
                {{-- Email Icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                <a href="mailto:info@tripfox.ru" class="hover:underline"> info@tripfox.ru</a>
            </li>
            <li class="flex items-center">
                {{-- Phone Icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                </svg>
                <a href="tel:+79874793776" class="hover:underline">+7 (987) 479-37-76</a>
            </li>
            <li class="flex items-center">
                {{-- Telegram Icon (custom SVG) --}}
                <svg class="w-5 h-5 mr-2 text-cyan-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9.036 16.758l-.38 4.444c.544 0 .778-.235 1.06-.517l2.54-2.44 5.266 3.847c.965.53 1.652.252 1.906-.89l3.45-16.178h-.001c.352-1.628-.59-2.26-1.615-1.863L1.907 9.8c-1.588.625-1.567 1.52-.28 1.92l4.967 1.551L19.358 5.93c.52-.355.993-.16.604.195"/>
                </svg>
                <a href="https://t.me/elenaexcurs" class="hover:underline">@tripfox</a>
            </li>
        </ul>
    </div>
@endsection



