<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminResponsableController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\StagiaireController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\TypeDocumentController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->middleware(['auth', 'role:admin','prevent-back-history'])->name('admin.')->group(function () {

    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    // CRUD Divisions
    Route::resource('divisions', DivisionController::class);

    // CRUD Services
    Route::resource('services', ServiceController::class);

    Route::resource('responsables', AdminResponsableController::class);
    // CRUD Pièces jointes
    Route::resource('types_documents', TypeDocumentController::class);
});

Route::middleware(['auth', 'role:responsable','prevent-back-history'])->group(function () {
    Route::get('/responsable/interface', [ResponsableController::class, 'index'])->name('responsable.interface');
});

Route::prefix('stagiaire')->middleware(['auth', 'role:stagiaire','prevent-back-history'])->name('stagiaire.')->group(function () {
    Route::get('dashboard', [StagiaireController::class, 'index'])->name('dashboard');
    Route::resource('demandes', DemandeController::class);

    Route::resource('documents', DocumentsController::class);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


