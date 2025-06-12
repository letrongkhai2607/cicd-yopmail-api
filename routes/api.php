<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailAliasController;
use App\Http\Controllers\OtpController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemporaryEmailController;


Route::middleware('api')->prefix('api')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'refresh']);

    Route::get('/email/generate', [TemporaryEmailController::class, 'generate']);
    Route::get('/email/list', [TemporaryEmailController::class, 'list']);

    Route::post('/otp/generate', [OtpController::class, 'generate']);
    Route::post('/otp/verify', [OtpController::class, 'verify']);


    Route::post('/alias/create', [EmailAliasController::class, 'create']);
});
