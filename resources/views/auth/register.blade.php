@extends('layouts.app')

@section('content')
    <div class="container max-w-md mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Регистрация клиента</h1>

        <form method="POST" action="{{ route('register.submit') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block">Имя</label>
                <input type="text" name="name" required class="form-input w-full" value="{{ old('name') }}">
            </div>

            <div>
                <label class="block">Email</label>
                <input type="email" name="email" required class="form-input w-full" value="{{ old('email') }}">
            </div>

            <div>
                <label class="block">Пароль</label>
                <input type="password" name="password" required class="form-input w-full">
            </div>

            <div>
                <label class="block">Повтор пароля</label>
                <input type="password" name="password_confirmation" required class="form-input w-full">
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Зарегистрироваться
            </button>
        </form>
    </div>
@endsection
