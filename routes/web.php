<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;

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
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});