<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTurmaRequest;
use App\Http\Requests\UpdateTurmaRequest;
use App\Repositories\TurmaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use Illuminate\Support\Facades\Auth;

class TurmaController extends AppBaseController
{
    /** @var  TurmaRepository */
    private $turmaRepository;

    public function __construct(TurmaRepository $turmaRepo)
    {
        $this->turmaRepository = $turmaRepo;
    }

    /**
     * Display a listing of the Turma.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $turmas = $this->turmaRepository->all();

        return view('turmas.index')
            ->with('turmas', $turmas);
    }

    /**
     * Show the form for creating a new Turma.
     *
     * @return Response
     */
    public function create()
    {
        return view('turmas.create');
    }

    /**
     * Store a newly created Turma in storage.
     *
     * @param CreateTurmaRequest $request
     *
     * @return Response
     */
    public function store(CreateTurmaRequest $request)
    {
        $input = $request->all();

        $turma = $this->turmaRepository->create($input);

        Flash::success('Turma criada com sucesso.');
        activity("Turma")->causedBy(Auth::user())->performedOn($turma)->log("Nova turma criada.");

        return redirect(route('turmas.index'));
    }

    /**
     * Display the specified Turma.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $turma = $this->turmaRepository->find($id);

        if (empty($turma)) {
            Flash::error('Turma not found');

            return redirect(route('turmas.index'));
        }

        return view('turmas.show')->with('turma', $turma);
    }

    /**
     * Show the form for editing the specified Turma.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $turma = $this->turmaRepository->find($id);

        if (empty($turma)) {
            Flash::error('Turma not found');

            return redirect(route('turmas.index'));
        }

        return view('turmas.edit')->with('turma', $turma);
    }

    /**
     * Update the specified Turma in storage.
     *
     * @param int $id
     * @param UpdateTurmaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTurmaRequest $request)
    {
        $turma = $this->turmaRepository->find($id);

        if (empty($turma)) {
            Flash::error('Turma not found');

            return redirect(route('turmas.index'));
        }

        $turma = $this->turmaRepository->update($request->all(), $id);

        Flash::success('Turma updated successfully.');

        return redirect(route('turmas.index'));
    }

    /**
     * Remove the specified Turma from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $turma = $this->turmaRepository->find($id);

        if (empty($turma)) {
            Flash::error('Turma not found');

            return redirect(route('turmas.index'));
        }

        $this->turmaRepository->delete($id);

        Flash::success('Turma deleted successfully.');

        return redirect(route('turmas.index'));
    }

    public function listUsers($id){
        $turma = $this->turmaRepository->find($id);
        $membros = $turma->user()->get();
        return view('user.index')->with('user', $membros);
    }
}
