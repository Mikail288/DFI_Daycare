<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController; // Import DashboardController

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role == 'admin') {
            return redirect()->route('dashboardadmin');
        } else {
            return redirect()->route('dashboard');
        }
    }
    return redirect()->route('login');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard'); 
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('dashboardadmin', [DashboardController::class, 'adminIndex'])->name('dashboardadmin');

// Tambahkan rute untuk mengedit dan menghapus pengguna
Route::get('users/{id}/edit', [AuthController::class, 'edit'])->name('users.edit');
Route::put('users/{id}', [AuthController::class, 'update'])->name('users.update');
Route::delete('users/{id}', [AuthController::class, 'destroy'])->name('users.destroy');