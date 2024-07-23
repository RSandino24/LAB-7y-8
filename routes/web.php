<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Definir las rutas de autenticación
Auth::routes();

// Ruta principal para tareas
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

// Rutas de recursos para tareas
Route::resource('tasks', TaskController::class)->except(['index']);
Route::put('tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');

// Redirigir a tareas después del inicio de sesión
Route::get('/', function () {
    return redirect()->route('tasks.index');

    Route::middleware('auth')->group(function () {
        Route::resource('tasks', TaskController::class);
    });
    
});
