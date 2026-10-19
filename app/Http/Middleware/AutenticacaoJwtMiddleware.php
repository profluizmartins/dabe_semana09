<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutenticacaoJwtMiddleware
{
    public function __construct(
        private AuthService $authService
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json([
                'erro' => 'Token de autenticação não fornecido ou cabeçalho mal formatado.'
            ], Response::HTTP_UNAUTHORIZED); // 401
        }

        $token = substr($authHeader, 7);

        try {
            $dadosUsuario = $this->authService->validarToken($token);
            // Injeta o utilizador autenticado nos atributos da requisição
            $request->attributes->set('usuario_autenticado', $dadosUsuario);
        } catch (Exception $e) {
            return response()->json([
                'erro' => 'Token inválido, corrompido ou expirado.'
            ], Response::HTTP_UNAUTHORIZED); // 401
        }

        return $next($request);
    }
}