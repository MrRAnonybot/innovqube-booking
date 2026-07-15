<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\PropertyCatalog;
use App\Livewire\BookProperty;
use App\Livewire\MyBookings;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/properties', PropertyCatalog::class)
    ->middleware(['auth'])
    ->name('properties.index');

Route::get('/properties/{property}/book', BookProperty::class)
    ->middleware(['auth'])
    ->name('properties.book');

Route::get('/my-bookings', MyBookings::class)
    ->middleware('auth')
    ->name('bookings.index');

require __DIR__.'/auth.php';
