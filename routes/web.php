<?php

use App\Http\Controllers\ExcursionController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [ExcursionController::class, 'index'])->name('home');
Route::get('excursion/{excursion:slug}', [ExcursionController::class, 'show'])->name('excursion.show');
