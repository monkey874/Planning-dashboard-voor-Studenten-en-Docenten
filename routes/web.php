<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [AgendaController::class, 'agenda'])->name('dashboard');
});

Route::get('/agenda1', [AgendaController::class, 'agenda'])->name('gast board');
Route::get('/agenda2', [AgendaController::class, 'agenda'])->name('docent board');

require __DIR__ . '/settings.php';
