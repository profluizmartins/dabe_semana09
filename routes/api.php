<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChamadoController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    
    // Rota pública de obtenção de token
    Route::post('/auth/login', [AuthController::class, 'login']);

    // Rotas protegidas que exigem Authorization: Bearer <token>
    Route::middleware('jwt.auth')->group(function () {
        Route::get('/chamados', [ChamadoController::class, 'index']);
        Route::post('/chamados', [ChamadoController::class, 'store']);
        Route::get('/chamados/{id}', [ChamadoController::class, 'show']);
    });
});