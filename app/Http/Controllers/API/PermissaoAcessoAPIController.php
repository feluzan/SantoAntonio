<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePermissaoAcessoAPIRequest;
use App\Http\Requests\API\UpdatePermissaoAcessoAPIRequest;
use App\Models\PermissaoAcesso;
use App\Repositories\PermissaoAcessoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PermissaoAcessoController
 * @package App\Http\Controllers\API
 */

class PermissaoAcessoAPIController extends AppBaseController
{
    /** @var  PermissaoAcessoRepository */
    private $permissaoAcessoRepository;

    public function __construct(PermissaoAcessoRepository $permissaoAcessoRepo)
    {
        $this->permissaoAcessoRepository = $permissaoAcessoRepo;
    }

    /**
     * Display a listing of the PermissaoAcesso.
     * GET|HEAD /permissaoAcessos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $permissaoAcessos = $this->permissaoAcessoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($permissaoAcessos->toArray(), 'Permissao Acessos retrieved successfully');
    }

    /**
     * Store a newly created PermissaoAcesso in storage.
     * POST /permissaoAcessos
     *
     * @param CreatePermissaoAcessoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePermissaoAcessoAPIRequest $request)
    {
        $input = $request->all();

        $permissaoAcesso = $this->permissaoAcessoRepository->create($input);

        return $this->sendResponse($permissaoAcesso->toArray(), 'Permissao Acesso saved successfully');
    }

    /**
     * Display the specified PermissaoAcesso.
     * GET|HEAD /permissaoAcessos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PermissaoAcesso $permissaoAcesso */
        $permissaoAcesso = $this->permissaoAcessoRepository->find($id);

        if (empty($permissaoAcesso)) {
            return $this->sendError('Permissao Acesso not found');
        }

        return $this->sendResponse($permissaoAcesso->toArray(), 'Permissao Acesso retrieved successfully');
    }

    /**
     * Update the specified PermissaoAcesso in storage.
     * PUT/PATCH /permissaoAcessos/{id}
     *
     * @param int $id
     * @param UpdatePermissaoAcessoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePermissaoAcessoAPIRequest $request)
    {
        $input = $request->all();

        /** @var PermissaoAcesso $permissaoAcesso */
        $permissaoAcesso = $this->permissaoAcessoRepository->find($id);

        if (empty($permissaoAcesso)) {
            return $this->sendError('Permissao Acesso not found');
        }

        $permissaoAcesso = $this->permissaoAcessoRepository->update($input, $id);

        return $this->sendResponse($permissaoAcesso->toArray(), 'PermissaoAcesso updated successfully');
    }

    /**
     * Remove the specified PermissaoAcesso from storage.
     * DELETE /permissaoAcessos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PermissaoAcesso $permissaoAcesso */
        $permissaoAcesso = $this->permissaoAcessoRepository->find($id);

        if (empty($permissaoAcesso)) {
            return $this->sendError('Permissao Acesso not found');
        }

        $permissaoAcesso->delete();

        return $this->sendSuccess('Permissao Acesso deleted successfully');
    }
}
