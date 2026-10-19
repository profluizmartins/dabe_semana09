<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService
{
    private string $jwtSecret = 'chave_secreta_super_segura_unievangelica_2026';
    private string $algoritmo = 'HS256';

    // Base de utilizadores simulada em memória
    private array $usuarios = [
        [
            'id' => 1,
            'nome' => 'Prof. Luiz Martins',
            'email' => 'luiz@unievangelica.edu.br',
            'senha' => '123456',
            'role' => 'ADMIN'
        ],
        [
            'id' => 2,
            'nome' => 'Aluno Teste',
            'email' => 'aluno@unievangelica.edu.br',
            'senha' => '123456',
            'role' => 'CLIENTE'
        ]
    ];

    public function autenticar(string $email, string $senha): array
    {
        $usuario = collect($this->usuarios)->firstWhere('email', $email);

        if (!$usuario || $usuario['senha'] !== $senha) {
            throw new UnauthorizedHttpException('Bearer', 'Credenciais inválidas ou utilizador não encontrado.');
        }

        // Payload stateless com claims RFC 7519
        $agora = time();
        $payload = [
            'iss' => 'helpdesk-api',
            'sub' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email'],
            'role' => $usuario['role'],
            'iat' => $agora,
            'exp' => $agora + 3600 // Válido por 1 hora
        ];

        $token = JWT::encode($payload, $this->jwtSecret, $this->algoritmo);

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => 3600,
            'usuario' => [
                'id' => $usuario['id'],
                'nome' => $usuario['nome'],
                'role' => $usuario['role']
            ]
        ];
    }

    public function validarToken(string $token): object
    {
        return JWT::decode($token, new Key($this->jwtSecret, $this->algoritmo));
    }
}