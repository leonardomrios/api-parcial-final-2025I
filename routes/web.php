<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Ruta para el listado de categorías (protegida por autenticación)
    // Nombre único para evitar conflicto con la ruta del API
    Route::get('/categories', [\App\Http\Controllers\Web\CategoryController::class, 'index'])
        ->name('web.categories.index');
});
