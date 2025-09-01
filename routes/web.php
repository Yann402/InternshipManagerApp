<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\StagiaireController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:responsable'])->group(function () {
    Route::get('/responsable/interface', [ResponsableController::class, 'index'])->name('responsable.interface');
});

Route::middleware(['auth', 'role:stagiaire'])->group(function () {
    Route::get('/stagiaire/interface', [StagiaireController::class, 'index'])->name('stagiaire.interface');
});

require __DIR__.'/auth.php';
