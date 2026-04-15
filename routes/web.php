<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Auth Pages
|--------------------------------------------------------------------------
*/
Route::post('/', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
/*
|--------------------------------------------------------------------------
| Public Landing Page (Bisa dilihat semua orang)
|--------------------------------------------------------------------------
*/
Route::get('/', [LaporanController::class, 'create'])->name('home');

/*
|--------------------------------------------------------------------------
| Protected Action (Hanya login bisa kirim laporan)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/laporan', [LaporanController::class, 'store'])
        ->name('laporan.store');
        Route::get('/laporan', [LaporanController::class, 'laporansaya']);
        });

