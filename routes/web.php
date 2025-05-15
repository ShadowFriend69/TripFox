<?php

use App\Http\Controllers\ExcursionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ExcursionController::class, 'index'])->name('home');
Route::get('excursion/{excursion:slug}', [ExcursionController::class, 'show'])->name('excursion.show');
Route::view('/about', 'about')->name('about');
