<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

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

require __DIR__.'/settings.php';
