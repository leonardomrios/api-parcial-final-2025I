<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\CategoryController;


Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('computers', ComputerController::class);
    Route::apiResource('categories', CategoryController::class);
    
    // Ruta adicional para categorías activas con sus computadoras relacionadas
    Route::get('categories-active', [CategoryController::class, 'active']);
});