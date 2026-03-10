<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\AlbumController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/foto', [FotoController::class, 'index'])->name('foto.index');
    Route::get('/foto/create', [FotoController::class, 'create'])->name('foto.create');
    Route::post('/foto', [FotoController::class, 'store'])->name('foto.store');
    Route::get('/foto/{id}', [FotoController::class, 'show'])->name('foto.show'); 
    Route::get('/foto/{id}/edit', [FotoController::class, 'edit'])->name('foto.edit');
    Route::put('/foto/{id}', [FotoController::class, 'update'])->name('foto.update');
    Route::delete('/foto/{id}', [FotoController::class, 'destroy'])->name('foto.destroy');

    Route::post('/foto/{id}/like', [FotoController::class, 'like'])->name('foto.like');
    Route::post('/foto/{id}/komentar', [FotoController::class, 'storeKomentar'])->name('komentar.store');
    Route::put('/komentar/{id}', [FotoController::class, 'updateKomentar'])->name('komentar.update');
    Route::delete('/komentar/{id}', [FotoController::class, 'destroyKomentar'])->name('komentar.destroy');
    Route::resource('albums', AlbumController::class);
});

require __DIR__.'/auth.php';