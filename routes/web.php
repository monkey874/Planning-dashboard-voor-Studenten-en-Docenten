<?php

use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AgendaController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [AgendaController::class, 'index'])->name('dashboard');
});

Route::get('/studentAgenda', [AgendaController::class, 'index'])->name('studentAgenda');

require __DIR__.'/settings.php';
