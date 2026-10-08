<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('layanan', LayananController::class);
    Route::get('admin/booking', [BookingController::class, 'indexAdmin'])->name('booking.admin.index');
    Route::patch('admin/booking/{booking}', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');
});

Route::middleware(['auth', 'role:pemilik_hewan'])->group(function () {
    Route::resource('hewan', HewanController::class);
    Route::get('booking', [BookingController::class, 'indexPemilik'])->name('booking.index');
    Route::get('booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('booking', [BookingController::class, 'store'])->name('booking.store');
});

require __DIR__.'/auth.php';
