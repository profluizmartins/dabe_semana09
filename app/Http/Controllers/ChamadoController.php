<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriarChamadoRequest;
use App\Services\ChamadoService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @tags Chamados
 * 
 * Endpoints responsáveis pelo ciclo de vida operacional dos chamados.
 */
class ChamadoController extends Controller
{
    public function __construct(
        private ChamadoService $service
    ) {}

    /**
     * Listar todos os chamados
     * 
     * Retorna a listagem cronológica de solicitações cadastradas.
     * 
     * @response 200 array{id: int, titulo: string, prioridade: string, status: string, criado_em: string}
     */
    public function index(): JsonResponse
    {
        $lista = $this->service->listarChamados();
        return response()->json($lista, Response::HTTP_OK);
    }

    /**
     * Abrir novo chamado
     * 
     * Registra uma nova solicitação a partir dos dados validados.
     * 
     * @response 201 array{id: int, titulo: string, prioridade: string, status: string, criado_em: string}
     * @response 422 {"message": "Os dados fornecidos são inválidos.", "errors": {"titulo": ["O campo título é obrigatório."]}}
     */
    public function store(CriarChamadoRequest $request): JsonResponse
    {
        $novoChamado = $this->service->registrarChamado($request->validated());
        return response()->json($novoChamado, Response::HTTP_CREATED);
    }

    /**
     * Consultar chamado por ID
     * 
     * @param int $id Identificador único do chamado
     * @response 200 array{id: int, titulo: string, prioridade: string, status: string, criado_em: string}
     * @response 404 {"erro": "Chamado não localizado."}
     */
    public function show(int $id): JsonResponse
    {
        $chamado = $this->service->obterChamado($id);
        return response()->json($chamado, Response::HTTP_OK);
    }
}