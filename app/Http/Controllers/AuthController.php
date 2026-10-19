<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @tags Autenticação
 * 
 * Gestão de credenciais e emissão de tokens JWT.
 */
class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}

    /**
     * Autenticar utilizador (Login)
     * 
     * Valida credenciais e devolve o Token JWT para autorização subsequente.
     * 
     * @response 200 array{access_token: string, token_type: string, expires_in: int, usuario: array{id: int, nome: string, role: string}}
     * @response 401 {"erro": "Credenciais inválidas ou utilizador não encontrado."}
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $dados = $this->authService->autenticar(
            $request->input('email'),
            $request->input('senha')
        );

        return response()->json($dados, Response::HTTP_OK);
    }
}