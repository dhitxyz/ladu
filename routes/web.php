<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminController;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [LaporanController::class, 'create'])->name('home');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::post('/laporan', [LaporanController::class, 'store'])
        ->name('laporan.store');

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::get('/laporan/{id}', [LaporanController::class, 'show'])
        ->name('laporan.show');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan.index');
    Route::get('/admin/laporan/{id}', [AdminController::class, 'showLaporan'])->name('admin.laporan.show');
    Route::post('/admin/laporan/{id}/status', [AdminController::class, 'updateStatusLaporan'])->name('admin.laporan.updateStatus');

    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/{id}', [AdminController::class, 'showUser'])->name('admin.users.show');
});
