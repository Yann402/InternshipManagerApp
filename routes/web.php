<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\StagiaireController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'role:admin','prevent-back-history'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:responsable','prevent-back-history'])->group(function () {
    Route::get('/responsable/interface', [ResponsableController::class, 'index'])->name('responsable.interface');
});

Route::middleware(['auth', 'role:stagiaire','prevent-back-history'])->group(function () {
    Route::get('/stagiaire/dashboard', [StagiaireController::class, 'index'])->name('stagiaire.dashboard');
});

Route::middleware('guest')->group(function () {
    // Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    // Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
