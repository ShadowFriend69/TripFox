<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ExcursionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ExcursionController::class, 'index'])->name('home');
Route::get('excursion/{excursion:slug}', [ExcursionController::class, 'show'])->name('excursion.show');
Route::view('/about', 'about')->name('about');

Route::middleware(['auth'])->group(function () {
    Route::post('/excursions/{excursion}/book', [BookingController::class, 'store'])->name('excursions.book');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});