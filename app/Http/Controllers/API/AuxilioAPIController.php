<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAuxilioAPIRequest;
use App\Http\Requests\API\UpdateAuxilioAPIRequest;
use App\Models\Auxilio;
use App\Repositories\AuxilioRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AuxilioController
 * @package App\Http\Controllers\API
 */

class AuxilioAPIController extends AppBaseController
{
    /** @var  AuxilioRepository */
    private $auxilioRepository;

    public function __construct(AuxilioRepository $auxilioRepo)
    {
        $this->auxilioRepository = $auxilioRepo;
    }

    /**
     * Display a listing of the Auxilio.
     * GET|HEAD /auxilios
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $auxilios = $this->auxilioRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($auxilios->toArray(), 'Auxilios retrieved successfully');
    }

    /**
     * Store a newly created Auxilio in storage.
     * POST /auxilios
     *
     * @param CreateAuxilioAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAuxilioAPIRequest $request)
    {
        $input = $request->all();

        $auxilio = $this->auxilioRepository->create($input);

        return $this->sendResponse($auxilio->toArray(), 'Auxilio saved successfully');
    }

    /**
     * Display the specified Auxilio.
     * GET|HEAD /auxilios/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Auxilio $auxilio */
        $auxilio = $this->auxilioRepository->find($id);

        if (empty($auxilio)) {
            return $this->sendError('Auxilio not found');
        }

        return $this->sendResponse($auxilio->toArray(), 'Auxilio retrieved successfully');
    }

    /**
     * Update the specified Auxilio in storage.
     * PUT/PATCH /auxilios/{id}
     *
     * @param int $id
     * @param UpdateAuxilioAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAuxilioAPIRequest $request)
    {
        $input = $request->all();

        /** @var Auxilio $auxilio */
        $auxilio = $this->auxilioRepository->find($id);

        if (empty($auxilio)) {
            return $this->sendError('Auxilio not found');
        }

        $auxilio = $this->auxilioRepository->update($input, $id);

        return $this->sendResponse($auxilio->toArray(), 'Auxilio updated successfully');
    }

    /**
     * Remove the specified Auxilio from storage.
     * DELETE /auxilios/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Auxilio $auxilio */
        $auxilio = $this->auxilioRepository->find($id);

        if (empty($auxilio)) {
            return $this->sendError('Auxilio not found');
        }

        $auxilio->delete();

        return $this->sendSuccess('Auxilio deleted successfully');
    }
}
