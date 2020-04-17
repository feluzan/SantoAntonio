<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRefeicaoAPIRequest;
use App\Http\Requests\API\UpdateRefeicaoAPIRequest;
use App\Models\Refeicao;
use App\Repositories\RefeicaoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RefeicaoController
 * @package App\Http\Controllers\API
 */

class RefeicaoAPIController extends AppBaseController
{
    /** @var  RefeicaoRepository */
    private $refeicaoRepository;

    public function __construct(RefeicaoRepository $refeicaoRepo)
    {
        $this->refeicaoRepository = $refeicaoRepo;
    }

    /**
     * Display a listing of the Refeicao.
     * GET|HEAD /refeicaos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $refeicaos = $this->refeicaoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($refeicaos->toArray(), 'Refeicaos retrieved successfully');
    }

    /**
     * Store a newly created Refeicao in storage.
     * POST /refeicaos
     *
     * @param CreateRefeicaoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRefeicaoAPIRequest $request)
    {
        
        $input = $request->all();
        dd($input);
        $refeicao = $this->refeicaoRepository->create($input);

        return $this->sendResponse($refeicao->toArray(), 'Refeicao saved successfully');
    }

    /**
     * Display the specified Refeicao.
     * GET|HEAD /refeicaos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Refeicao $refeicao */
        $refeicao = $this->refeicaoRepository->find($id);

        if (empty($refeicao)) {
            return $this->sendError('Refeicao not found');
        }

        return $this->sendResponse($refeicao->toArray(), 'Refeicao retrieved successfully');
    }

    /**
     * Update the specified Refeicao in storage.
     * PUT/PATCH /refeicaos/{id}
     *
     * @param int $id
     * @param UpdateRefeicaoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRefeicaoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Refeicao $refeicao */
        $refeicao = $this->refeicaoRepository->find($id);

        if (empty($refeicao)) {
            return $this->sendError('Refeicao not found');
        }

        $refeicao = $this->refeicaoRepository->update($input, $id);

        return $this->sendResponse($refeicao->toArray(), 'Refeicao updated successfully');
    }

    /**
     * Remove the specified Refeicao from storage.
     * DELETE /refeicaos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Refeicao $refeicao */
        $refeicao = $this->refeicaoRepository->find($id);

        if (empty($refeicao)) {
            return $this->sendError('Refeicao not found');
        }

        $refeicao->delete();

        return $this->sendSuccess('Refeicao deleted successfully');
    }
}
