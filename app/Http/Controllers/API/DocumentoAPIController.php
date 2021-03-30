<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDocumentoAPIRequest;
use App\Http\Requests\API\UpdateDocumentoAPIRequest;
use App\Models\Documento;
use App\Repositories\DocumentoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DocumentoController
 * @package App\Http\Controllers\API
 */

class DocumentoAPIController extends AppBaseController
{
    /** @var  DocumentoRepository */
    private $documentoRepository;

    public function __construct(DocumentoRepository $documentoRepo)
    {
        $this->documentoRepository = $documentoRepo;
    }

    /**
     * Display a listing of the Documento.
     * GET|HEAD /documentos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $documentos = $this->documentoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($documentos->toArray(), 'Documentos retrieved successfully');
    }

    /**
     * Store a newly created Documento in storage.
     * POST /documentos
     *
     * @param CreateDocumentoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDocumentoAPIRequest $request)
    {
        $input = $request->all();

        $documento = $this->documentoRepository->create($input);

        return $this->sendResponse($documento->toArray(), 'Documento saved successfully');
    }

    /**
     * Display the specified Documento.
     * GET|HEAD /documentos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Documento $documento */
        $documento = $this->documentoRepository->find($id);

        if (empty($documento)) {
            return $this->sendError('Documento not found');
        }

        return $this->sendResponse($documento->toArray(), 'Documento retrieved successfully');
    }

    /**
     * Update the specified Documento in storage.
     * PUT/PATCH /documentos/{id}
     *
     * @param int $id
     * @param UpdateDocumentoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDocumentoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Documento $documento */
        $documento = $this->documentoRepository->find($id);

        if (empty($documento)) {
            return $this->sendError('Documento not found');
        }

        $documento = $this->documentoRepository->update($input, $id);

        return $this->sendResponse($documento->toArray(), 'Documento updated successfully');
    }

    /**
     * Remove the specified Documento from storage.
     * DELETE /documentos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Documento $documento */
        $documento = $this->documentoRepository->find($id);

        if (empty($documento)) {
            return $this->sendError('Documento not found');
        }

        $documento->delete();

        return $this->sendSuccess('Documento deleted successfully');
    }
}
