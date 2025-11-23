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
    return \Inertia\Inertia::render('Dashboard');
})->name('dashboard');

    // Rutas para el CRUD completo de categorías (protegidas por autenticación)
    // Nombres únicos con prefijo 'web.' para evitar conflicto con rutas del API
    Route::get('/categories', [\App\Http\Controllers\Web\CategoryController::class, 'index'])
        ->name('web.categories.index');
    Route::get('/categories/create', [\App\Http\Controllers\Web\CategoryController::class, 'create'])
        ->name('web.categories.create');
    Route::post('/categories', [\App\Http\Controllers\Web\CategoryController::class, 'store'])
        ->name('web.categories.store');
    Route::get('/categories/{category}', [\App\Http\Controllers\Web\CategoryController::class, 'show'])
        ->name('web.categories.show');
    Route::get('/categories/{category}/edit', [\App\Http\Controllers\Web\CategoryController::class, 'edit'])
        ->name('web.categories.edit');
    Route::put('/categories/{category}', [\App\Http\Controllers\Web\CategoryController::class, 'update'])
        ->name('web.categories.update');
    Route::delete('/categories/{category}', [\App\Http\Controllers\Web\CategoryController::class, 'destroy'])
        ->name('web.categories.destroy');

    // Rutas para el CRUD completo de computadoras (protegidas por autenticación)
    Route::get('/computers', [\App\Http\Controllers\Web\ComputerController::class, 'index'])
        ->name('web.computers.index');
    Route::get('/computers/create', [\App\Http\Controllers\Web\ComputerController::class, 'create'])
        ->name('web.computers.create');
    Route::post('/computers', [\App\Http\Controllers\Web\ComputerController::class, 'store'])
        ->name('web.computers.store');
    Route::get('/computers/{computer}', [\App\Http\Controllers\Web\ComputerController::class, 'show'])
        ->name('web.computers.show');
    Route::get('/computers/{computer}/edit', [\App\Http\Controllers\Web\ComputerController::class, 'edit'])
        ->name('web.computers.edit');
    Route::put('/computers/{computer}', [\App\Http\Controllers\Web\ComputerController::class, 'update'])
        ->name('web.computers.update');
    Route::delete('/computers/{computer}', [\App\Http\Controllers\Web\ComputerController::class, 'destroy'])
        ->name('web.computers.destroy');
});
