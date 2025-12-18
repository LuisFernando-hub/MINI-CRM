<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return response()->json(['status' => 'API is running']);
});

Route::group(['prefix' => 'ticket'], function () {
    Route::get('/', [\App\Http\Controllers\TicketController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\TicketController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\TicketController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\TicketController::class, 'update']);
    Route::delete('/{id}', [\App\Http\Controllers\TicketController::class, 'destroy']);
});
