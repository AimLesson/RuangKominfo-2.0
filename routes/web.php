<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;

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

    //akses spesial admin bagian Jadwal
    Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('booking.update');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');

    //akses spesial admin bagian Ruangan
    Route::get('/rooms/{room}/edit', [BookingController::class, 'editroom'])->name('rooms.edit');
    Route::put('/rooms/{room}', [BookingController::class, 'updateroom'])->name('rooms.update');
    Route::delete('/rooms/{room}', [BookingController::class, 'destroyRoom'])->name('rooms.destroy');

    //akses admin untuk update status jadwal
    Route::patch('/booking/{booking}/update-status', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');

});
    //akses umum jadwal
    Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('booking.store');

    //akses umum ruangan
    Route::get('/rooms', [BookingController::class, 'indexroom'])->name('rooms.index');
    Route::get('/rooms/create', [BookingController::class, 'createroom'])->name('rooms.create');
    Route::post('/rooms', [BookingController::class, 'storeroom'])->name('rooms.store');
    Route::get('/rooms/{room}', [BookingController::class, 'show'])->name('rooms.show');

require __DIR__.'/auth.php';
