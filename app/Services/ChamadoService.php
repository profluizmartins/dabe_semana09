<?php

namespace App\Services;

use App\Repositories\ChamadoRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ChamadoService
{
    public function __construct(
        private ChamadoRepository $repository
    ) {}

    public function registrarChamado(array $dadosValidados): array
    {
        return $this->repository->salvar($dadosValidados);
    }

    public function obterChamado(int $id): array
    {
        $chamado = $this->repository->buscarPorId($id);

        if (!$chamado) {
            throw new NotFoundHttpException("Chamado com identificador {$id} não localizado.");
        }

        return $chamado;
    }

    public function listarChamados(): array
    {
        return $this->repository->listarTodos();
    }
}