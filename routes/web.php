<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTE
|--------------------------------------------------------------------------
*/

Route::get('/', [LaporanController::class, 'create'])->name('home');


/*
|--------------------------------------------------------------------------
| USER ROUTES (ROLE: USER)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:user'])->group(function () {


    // CRUD laporan user
    Route::post('/laporan', [LaporanController::class, 'store'])
        ->name('laporan.store');

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::get('/laporan/{id}', [LaporanController::class, 'show'])
        ->name('laporan.show');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (ROLE: ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard admin
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Laporan
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan.index');
    Route::get('/admin/laporan/{id}', [AdminController::class, 'showLaporan'])->name('admin.laporan.show');
    Route::post('/admin/laporan/{id}/status', [AdminController::class, 'updateStatusLaporan'])->name('admin.laporan.updateStatus');

    // Users
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/{id}', [AdminController::class, 'showUser'])->name('admin.users.show');
    Route::post('/admin/users/{id}/verify', [AdminController::class, 'verifyUserEmail'])->name('admin.users.verify');
    Route::post('/admin/users/{id}/unverify', [AdminController::class, 'unverifyUserEmail'])->name('admin.users.unverify');
});
