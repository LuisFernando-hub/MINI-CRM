<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login',[\App\Http\Controllers\LoginApiController::class, 'login']);

Route::get('/', function () {
    return response()->json(['status' => 'API is running']);
});

Route::group(['prefix' => 'tickets'], function () {
    Route::get('/', [\App\Http\Controllers\TicketController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/', [\App\Http\Controllers\TicketController::class, 'store']);
    Route::get('/', [\App\Http\Controllers\TicketController::class, 'create']);
    Route::get('/{id}', [\App\Http\Controllers\TicketController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/{id}', [\App\Http\Controllers\TicketController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/{id}', [\App\Http\Controllers\TicketController::class, 'destroy'])->middleware('auth:sanctum');
});