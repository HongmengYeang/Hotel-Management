<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingDetailController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\ServiceController;
use App\Models\Booking;
use App\Models\BookingService;
use App\Models\Customer;
use Illuminate\Support\Facades\Route;

Route::get('/',[DashboardController::class,"index"])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard', function () {
    
// });

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::resource("/room",RoomController::class);
Route::resource("/room_type",RoomTypeController::class);
Route::resource("/customer",CustomerController::class);
Route::resource("/service",ServiceController::class);
Route::resource("/booking",BookingController::class);
Route::resource("/booking_service",BookingService::class);

require __DIR__.'/auth.php';
