<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissaoAcessoRequest;
use App\Http\Requests\UpdatePermissaoAcessoRequest;
use App\Repositories\PermissaoAcessoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PermissaoAcessoController extends AppBaseController
{
    /** @var  PermissaoAcessoRepository */
    private $permissaoAcessoRepository;

    public function __construct(PermissaoAcessoRepository $permissaoAcessoRepo)
    {
        $this->permissaoAcessoRepository = $permissaoAcessoRepo;
    }

    /**
     * Display a listing of the PermissaoAcesso.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $permissaoAcessos = $this->permissaoAcessoRepository->all();

        return view('permissao_acessos.index')
            ->with('permissaoAcessos', $permissaoAcessos);
    }

    /**
     * Show the form for creating a new PermissaoAcesso.
     *
     * @return Response
     */
    public function create()
    {
        return view('permissao_acessos.create');
    }

    /**
     * Store a newly created PermissaoAcesso in storage.
     *
     * @param CreatePermissaoAcessoRequest $request
     *
     * @return Response
     */
    public function store(CreatePermissaoAcessoRequest $request)
    {
        $input = $request->all();

        $permissaoAcesso = $this->permissaoAcessoRepository->create($input);

        Flash::success('Permissao Acesso saved successfully.');

        return redirect(route('user.edit',[$input['user_id']]));
    }

    /**
     * Display the specified PermissaoAcesso.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $permissaoAcesso = $this->permissaoAcessoRepository->find($id);

        if (empty($permissaoAcesso)) {
            Flash::error('Permissao Acesso not found');

            return redirect(route('permissaoAcessos.index'));
        }

        return view('permissao_acessos.show')->with('permissaoAcesso', $permissaoAcesso);
    }

    /**
     * Show the form for editing the specified PermissaoAcesso.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $permissaoAcesso = $this->permissaoAcessoRepository->find($id);

        if (empty($permissaoAcesso)) {
            Flash::error('Permissao Acesso not found');

            return redirect(route('permissaoAcessos.index'));
        }

        return view('permissao_acessos.edit')->with('permissaoAcesso', $permissaoAcesso);
    }

    /**
     * Update the specified PermissaoAcesso in storage.
     *
     * @param int $id
     * @param UpdatePermissaoAcessoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePermissaoAcessoRequest $request)
    {
        $permissaoAcesso = $this->permissaoAcessoRepository->find($id);

        if (empty($permissaoAcesso)) {
            Flash::error('Permissao Acesso not found');

            return redirect(route('permissaoAcessos.index'));
        }

        $permissaoAcesso = $this->permissaoAcessoRepository->update($request->all(), $id);

        Flash::success('Permissao Acesso updated successfully.');

        return redirect(route('permissaoAcessos.index'));
    }

    /**
     * Remove the specified PermissaoAcesso from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $permissaoAcesso = $this->permissaoAcessoRepository->find($id);
        $user_id = $permissaoAcesso->user_id;

        if (empty($permissaoAcesso)) {
            // Flash::error('Permissao Acesso not found');
            return redirect(route('user.edit',[$user_id]));
        }

        $this->permissaoAcessoRepository->delete($id);
        // Flash::success('Permissao Acesso deleted successfully.');
        return redirect(route('user.edit',[$user_id]));
    }
}
