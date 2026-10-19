<?php

use App\Http\Controllers\ChamadoController;
use Illuminate\Support\Facades\Route;

// Remova ou comente a rota padrão Route::get('/user', ...) que vem com o Sanctum

Route::prefix('v1')->group(function () {
    Route::get('/chamados', [ChamadoController::class, 'index']);
    Route::post('/chamados', [ChamadoController::class, 'store']);
    Route::get('/chamados/{id}', [ChamadoController::class, 'show']);
});