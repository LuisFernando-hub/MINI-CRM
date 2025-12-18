<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
});

Route::group(['prefix' => 'tickets'], function () {
    Route::get('/', [\App\Http\Controllers\TicketController::class, 'index'])->middleware('auth');
    Route::post('/', [\App\Http\Controllers\TicketController::class, 'store'])->name('tickets.store')->middleware('auth');
    Route::get('/', [\App\Http\Controllers\TicketController::class, 'create'])->name('tickets.create')->middleware('auth');
    Route::get('/{id}', [\App\Http\Controllers\TicketController::class, 'show'])->middleware('auth');
    Route::put('/{id}', [\App\Http\Controllers\TicketController::class, 'update'])->middleware('auth');
    Route::delete('/{id}', [\App\Http\Controllers\TicketController::class, 'destroy'])->middleware('auth');
});

require __DIR__.'/auth.php';
