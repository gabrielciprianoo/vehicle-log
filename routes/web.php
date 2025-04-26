<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;


Route::get('/', [VehicleController::class, 'index'])->name('home');


Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');

// Ruta para editar un vehículo
Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('vehicles.update');

// Ruta para eliminar un vehículo
Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

// Ruta para ver los detalles de un vehículo (opcional si quieres mostrar más detalles)
Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('vehicles.show');

