<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'senha' => 'required|string|min:6',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'email' => [
                'description' => 'E-mail cadastrado do utilizador.',
                'example' => 'luiz@unievangelica.edu.br',
            ],
            'senha' => [
                'description' => 'Senha de acesso.',
                'example' => '123456',
            ],
        ];
    }
}