<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\UserController;
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

    Route::resource('activities', ActivityController::class)
        ->middleware(['permission:view activities']);

    Route::middleware(['permission:create activities'])->group(function () {
        Route::get('activities/create', [ActivityController::class, 'create'])->name('activities.create');
        Route::post('activities', [ActivityController::class, 'store'])->name('activities.store');
    });

    Route::middleware(['permission:edit activities'])->group(function () {
        Route::get('activities/{activity}/edit', [ActivityController::class, 'edit'])->name('activities.edit');
        Route::put('activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
    });

    Route::middleware(['permission:delete activities'])->group(function () {
        Route::delete('activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');
    });
});

Route::middleware(['auth', 'verified', 'role:superbeheerder'])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::post('users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
});

Route::get('/studentAgenda', [AgendaController::class, 'index'])->name('studentAgenda');
Route::get('/excel', [ExcelController::class, 'index'])->name('excel');

require __DIR__ . '/settings.php';
