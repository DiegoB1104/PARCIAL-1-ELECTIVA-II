<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PedidoController;

Route::get('/', [PedidoController::class, 'crear'])->name('pedidos.crear');
Route::post('/pedidos/confirmar', [PedidoController::class, 'confirmar'])->name('pedidos.confirmar');
Route::get('/pedidos/{id}/editar', [PedidoController::class, 'editar'])->name('pedidos.editar');
Route::post('/pedidos/{id}/actualizar', [PedidoController::class, 'actualizar'])->name('pedidos.actualizar');
Route::delete('/pedidos/{id}', [PedidoController::class, 'eliminar'])->name('pedidos.eliminar');


