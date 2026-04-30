<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'check.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/absences-retards', [AdminController::class, 'absencesRetards'])->name('absences');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
});
require __DIR__ . '/auth.php';
// Chef de département
Route::middleware(['auth', 'check.chef'])->prefix('chef')->name('chef.')->group(function () {
    Route::get('/dashboard', [ChefController::class, 'dashboard'])->name('dashboard');
    Route::post('/pointage', [ChefController::class, 'storePointage'])->name('storePointage');
    Route::post('/submit', [ChefController::class, 'submitReport'])->name('submit');
});

// Utilisateur simple
Route::middleware(['auth', 'check.user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});
