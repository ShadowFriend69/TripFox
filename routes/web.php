<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ExcursionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ExcursionController::class, 'index'])->name('home');
Route::get('excursion/{excursion:slug}', [ExcursionController::class, 'show'])->name('excursion.show');
Route::view('/about', 'about')->name('about');

Route::middleware(['auth'])->group(function () {
    Route::post('/excursions/{excursion}/book', [BookingController::class, 'store'])->name('excursions.book');
});