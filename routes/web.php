<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;

// Redirect ke login jika root diakses
Route::get('/', function () {
    return redirect('/login');
});

// Rute untuk otentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Halaman login
Route::post('/login', [AuthController::class, 'login']); // Proses login
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register'); // Halaman registrasi
Route::post('/register', [AuthController::class, 'register']); // Proses registrasi
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Proses logout

// Rute yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute untuk kategori
    Route::resource('categories', CategoryController::class);

    // Rute untuk menu
    Route::resource('menus', MenuController::class);

    // Rute untuk pesanan
    Route::resource('orders', OrderController::class);
});
