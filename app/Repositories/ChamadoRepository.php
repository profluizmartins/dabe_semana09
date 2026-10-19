<?php

namespace App\Repositories;

class ChamadoRepository
{
    private static array $chamados = [
        1 => [
            'id' => 1,
            'titulo' => 'Instalação de software estatístico',
            'descricao' => 'Instalar pacote de ferramentas no Lab 02.',
            'prioridade' => 'BAIXA',
            'categoria_id' => 1,
            'status' => 'FECHADO',
            'criado_em' => '2026-10-18T10:00:00Z'
        ]
    ];

    public function salvar(array $dados): array
    {
        $novoId = count(self::$chamados) + 1;
        $registro = array_merge(['id' => $novoId], $dados, [
            'status' => 'ABERTO',
            'criado_em' => now()->toIso8601String()
        ]);

        self::$chamados[$novoId] = $registro;
        return $registro;
    }

    public function listarTodos(): array
    {
        return array_values(self::$chamados);
    }

    public function buscarPorId(int $id): ?array
    {
        return self::$chamados[$id] ?? null;
    }
}