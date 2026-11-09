<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Models\Layanan;

Route::get('/', function () {
    $layanan = Layanan::all(); //
    return view('welcome', compact('layanan'));
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('layanan', LayananController::class);
    Route::get('admin/booking', [BookingController::class, 'indexAdmin'])->name('booking.admin.index');
    Route::patch('admin/booking/{booking}', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');
    Route::post('admin/booking/{booking}/foto', [BookingController::class, 'uploadFoto'])->name('booking.uploadFoto');
});

Route::middleware(['auth', 'role:pemilik_hewan'])->group(function () {
    Route::resource('hewan', HewanController::class);
    Route::get('booking', [BookingController::class, 'indexPemilik'])->name('booking.index');
    Route::get('booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('booking', [BookingController::class, 'store'])->name('booking.store');
    Route::patch('booking/{booking}/batal', [BookingController::class, 'batal'])->name('booking.batal');
});

require __DIR__.'/auth.php';