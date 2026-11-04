<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/events', [PageController::class, 'events'])->name('events');
Route::get('/menu', [PageController::class, 'menu'])->name('menu');
Route::get('/book', [PageController::class, 'book'])->name('book');
Route::get('/search', [PageController::class, 'search'])->name('search');
Route::post('/book', [ReservationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('book.store');
