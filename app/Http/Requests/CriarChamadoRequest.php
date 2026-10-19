<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CriarChamadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string|min:5|max:100',
            'descricao' => 'nullable|string|max:1000',
            'prioridade' => 'required|in:BAIXA,MEDIA,ALTA',
            'categoria_id' => 'required|integer',
        ];
    }
	
	public function bodyParameters(): array
    {
        return [
            'titulo' => [
                'description' => 'Título resumido do chamado.',
                'example' => 'Falha de conexão no switch do Bloco B',
            ],
            'descricao' => [
                'description' => 'Detalhamento técnico do problema.',
                'example' => 'Portas 1 a 12 inoperantes após oscilação de energia.',
            ],
            'prioridade' => [
                'description' => 'Gravidade do chamado técnico.',
                'example' => 'ALTA',
            ],
            'categoria_id' => [
                'description' => 'ID da categoria de atendimento.',
                'example' => 2,
            ],
        ];
    }
	
	
}
