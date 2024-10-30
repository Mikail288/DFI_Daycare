<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChildController;

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

Route::middleware('auth')->group(function () {
    Route::get('dashboard/{child_id?}', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboardadmin', [DashboardController::class, 'adminIndex'])->name('dashboardadmin');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('users/{id}/edit', [AuthController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [AuthController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [AuthController::class, 'destroy'])->name('users.destroy');
    
    Route::post('children', [ChildController::class, 'store'])->name('children.store');
    Route::delete('children/{id}', [ChildController::class, 'destroy'])->name('children.destroy');
    
    Route::get('users/{id}', [AuthController::class, 'show'])->name('users.show');
    
    Route::get('dashboardanak', [DashboardController::class, 'childIndex'])->name('dashboardanak');
    
    Route::match(['put', 'post'], 'children/{id}/update-status', [ChildController::class, 'updateStatus'])->name('children.updateStatus');
    
    Route::get('children/{id}/edit-status', [ChildController::class, 'editStatus'])->name('children.editStatus');
    
    Route::get('/searchanak', [ChildController::class, 'search'])->name('children.search');
    
    Route::get('/searchuser', [AuthController::class, 'search'])->name('users.search');
    
    Route::get('dashboard/history/{id}', [ChildController::class, 'showHistory'])->name('children.history');
    
    Route::get('dashboardanak/info/{id}', [ChildController::class, 'showInfo'])->name('children.info');
    
    Route::post('children/{id}/download-excel', [ChildController::class, 'downloadExcel'])->name('children.downloadExcel');
});

Route::fallback(function () {
    return redirect()->route('login');
});
