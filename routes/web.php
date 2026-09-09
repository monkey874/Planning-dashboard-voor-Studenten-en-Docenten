<?php

use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AgendaController::class, 'agenda'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [AgendaController::class, 'agenda'])->name('dashboard');
});

Route::get('/studentAgenda', [AgendaController::class, 'agenda'])->name('gast board');
Route::get('/publicAgenda', [AgendaController::class, 'agenda'])->name('public board');

require __DIR__ . '/settings.php';
