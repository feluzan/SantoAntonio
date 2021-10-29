<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTurmaAPIRequest;
use App\Http\Requests\API\UpdateTurmaAPIRequest;
use App\Models\Turma;
use App\Repositories\TurmaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TurmaResource;
use Response;

/**
 * Class TurmaController
 * @package App\Http\Controllers\API
 */

class TurmaAPIController extends AppBaseController
{
    /** @var  TurmaRepository */
    private $turmaRepository;

    public function __construct(TurmaRepository $turmaRepo)
    {
        $this->turmaRepository = $turmaRepo;
    }

    /**
     * Display a listing of the Turma.
     * GET|HEAD /turmas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $turmas = $this->turmaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TurmaResource::collection($turmas), 'Turmas retrieved successfully');
    }

    /**
     * Store a newly created Turma in storage.
     * POST /turmas
     *
     * @param CreateTurmaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTurmaAPIRequest $request)
    {
        $input = $request->all();

        $turma = $this->turmaRepository->create($input);

        return $this->sendResponse(new TurmaResource($turma), 'Turma saved successfully');
    }

    /**
     * Display the specified Turma.
     * GET|HEAD /turmas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Turma $turma */
        $turma = $this->turmaRepository->find($id);

        if (empty($turma)) {
            return $this->sendError('Turma not found');
        }

        return $this->sendResponse(new TurmaResource($turma), 'Turma retrieved successfully');
    }

    /**
     * Update the specified Turma in storage.
     * PUT/PATCH /turmas/{id}
     *
     * @param int $id
     * @param UpdateTurmaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTurmaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Turma $turma */
        $turma = $this->turmaRepository->find($id);

        if (empty($turma)) {
            return $this->sendError('Turma not found');
        }

        $turma = $this->turmaRepository->update($input, $id);

        return $this->sendResponse(new TurmaResource($turma), 'Turma updated successfully');
    }

    /**
     * Remove the specified Turma from storage.
     * DELETE /turmas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Turma $turma */
        $turma = $this->turmaRepository->find($id);

        if (empty($turma)) {
            return $this->sendError('Turma not found');
        }

        $turma->delete();

        return $this->sendSuccess('Turma deleted successfully');
    }
}
