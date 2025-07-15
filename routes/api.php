<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
    Route::apiResource('profiles', \App\Http\Controllers\ProfileController::class);
    // Sports
    Route::get('sports', [\App\Http\Controllers\SportController::class, 'index']);
    Route::get('sports/{sport}', [\App\Http\Controllers\SportController::class, 'show']);
    Route::post('sports', [\App\Http\Controllers\SportController::class, 'store'])->middleware(\App\Http\Middleware\AdminMiddleware::class);
    Route::put('sports/{sport}', [\App\Http\Controllers\SportController::class, 'update'])->middleware(\App\Http\Middleware\AdminMiddleware::class);
    Route::delete('sports/{sport}', [\App\Http\Controllers\SportController::class, 'destroy'])->middleware(\App\Http\Middleware\AdminMiddleware::class);

    // Courts
    Route::get('courts', [\App\Http\Controllers\CourtController::class, 'index']);
    Route::get('courts/{court}', [\App\Http\Controllers\CourtController::class, 'show']);
    Route::post('courts', [\App\Http\Controllers\CourtController::class, 'store'])->middleware(\App\Http\Middleware\AdminMiddleware::class);
    Route::put('courts/{court}', [\App\Http\Controllers\CourtController::class, 'update'])->middleware(\App\Http\Middleware\AdminMiddleware::class);
    Route::delete('courts/{court}', [\App\Http\Controllers\CourtController::class, 'destroy'])->middleware(\App\Http\Middleware\AdminMiddleware::class);
    Route::apiResource('friendly_matches', \App\Http\Controllers\FriendlyMatchController::class);
    Route::post('friendly_matches/{id}/join', [\App\Http\Controllers\FriendlyMatchController::class, 'join']);
    Route::post('friendly_matches/{id}/leave', [\App\Http\Controllers\FriendlyMatchController::class, 'leave']);
}); 