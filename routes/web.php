<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ExcelController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AgendaController::class, 'index'])->name('home');

use App\Http\Controllers\CalendarFeedController;
use App\Http\Controllers\SubscriptionController;


Route::get('/subscription', [SubscriptionController::class, 'index'])->name('sub');
Route::get('/subscription/{opleiding}/{groep}', [SubscriptionController::class, 'show'])->name('sub.show');
Route::get('/calendar/{opleiding}/{groep}.ics', [CalendarFeedController::class, 'feed'])
    ->name('calendar.feed');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [AgendaController::class, 'index'])->name('dashboard');
});

Route::get('/studentAgenda', [AgendaController::class, 'index'])->name('studentAgenda');
Route::get('/excel', [ExcelController::class, 'index']);

require __DIR__ . '/settings.php';
