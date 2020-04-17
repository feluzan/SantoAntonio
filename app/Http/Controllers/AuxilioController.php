<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuxilioRequest;
use App\Http\Requests\UpdateAuxilioRequest;
use App\Repositories\AuxilioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\User;

class AuxilioController extends AppBaseController
{
    /** @var  AuxilioRepository */
    private $auxilioRepository;

    public function __construct(AuxilioRepository $auxilioRepo)
    {
        $this->auxilioRepository = $auxilioRepo;
    }

    /**
     * Display a listing of the Auxilio.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $auxilios = $this->auxilioRepository->all();

        return view('auxilios.index')
            ->with('auxilios', $auxilios);
    }

    /**
     * Show the form for creating a new Auxilio.
     *
     * @return Response
     */
    public function create()
    {
        return view('auxilios.create');
    }

    /**
     * Store a newly created Auxilio in storage.
     *
     * @param CreateAuxilioRequest $request
     *
     * @return Response
     */
    public function store(CreateAuxilioRequest $request)
    {
        $input = $request->all();

        $auxilio = $this->auxilioRepository->create($input);

        Flash::success('Auxilio saved successfully.');

        return redirect(route('auxilios.index'));
    }

    /**
     * Display the specified Auxilio.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $auxilio = $this->auxilioRepository->find($id);

        if (empty($auxilio)) {
            Flash::error('Auxilio not found');

            return redirect(route('auxilios.index'));
        }

        return view('auxilios.show')->with('auxilio', $auxilio);
    }

    /**
     * Show the form for editing the specified Auxilio.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $auxilio = $this->auxilioRepository->find($id);

        if (empty($auxilio)) {
            Flash::error('Auxilio not found');

            return redirect(route('auxilios.index'));
        }

        return view('auxilios.edit')->with('auxilio', $auxilio);
    }

    /**
     * Update the specified Auxilio in storage.
     *
     * @param int $id
     * @param UpdateAuxilioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAuxilioRequest $request)
    {
        $auxilio = $this->auxilioRepository->find($id);

        if (empty($auxilio)) {
            Flash::error('Auxilio not found');

            return redirect(route('auxilios.index'));
        }

        $auxilio = $this->auxilioRepository->update($request->all(), $id);

        Flash::success('Auxilio updated successfully.');

        return redirect(route('auxilios.index'));
    }

    /**
     * Remove the specified Auxilio from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $auxilio = $this->auxilioRepository->find($id);

        if (empty($auxilio)) {
            Flash::error('Auxilio not found');

            return redirect(route('auxilios.index'));
        }

        $this->auxilioRepository->delete($id);

        Flash::success('Auxilio deleted successfully.');

        return redirect(route('auxilios.index'));
    }

    public function auxilioIndividual(User $user){

        dd($user);
        return view('auxilio.individual', compact('user'));
    }
}
