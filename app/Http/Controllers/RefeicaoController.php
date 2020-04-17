<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRefeicaoRequest;
use App\Http\Requests\UpdateRefeicaoRequest;
use App\Repositories\RefeicaoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Auxilio;

class RefeicaoController extends AppBaseController
{
    /** @var  RefeicaoRepository */
    private $refeicaoRepository;

    public function __construct(RefeicaoRepository $refeicaoRepo)
    {
        $this->refeicaoRepository = $refeicaoRepo;
    }

    /**
     * Display a listing of the Refeicao.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $refeicaos = $this->refeicaoRepository->all();

        return view('refeicaos.index')
            ->with('refeicaos', $refeicaos);
    }

    /**
     * Show the form for creating a new Refeicao.
     *
     * @return Response
     */
    public function create()
    {
        
        return view('refeicaos.create');
    }

    
    /**
     * Store a newly created Refeicao in storage.
     *
     * @param CreateRefeicaoRequest $request
     *
     * @return Response
     */
    public function store(CreateRefeicaoRequest $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|max:255',
            'inicio' => 'required',
            'fim' => 'required',
            'valor' => 'required',
        ]);
        $input = $request->all();
        // dd($input);

        $refeicao = $this->refeicaoRepository->create($input);

        Flash::success('Refeicao saved successfully.');

        return redirect(route('refeicaos.index'));
    }

    /**
     * Display the specified Refeicao.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $refeicao = $this->refeicaoRepository->find($id);

        if (empty($refeicao)) {
            Flash::error('Refeicao not found');

            return redirect(route('refeicaos.index'));
        }

        return view('refeicaos.show')->with('refeicao', $refeicao);
    }

    /**
     * Show the form for editing the specified Refeicao.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $refeicao = $this->refeicaoRepository->find($id);

        if (empty($refeicao)) {
            Flash::error('Refeicão não encontrada');

            return redirect(route('refeicaos.index'));
        }

        return view('refeicaos.edit')->with('refeicao', $refeicao);
    }

    /**
     * Update the specified Refeicao in storage.
     *
     * @param int $id
     * @param UpdateRefeicaoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRefeicaoRequest $request)
    {
        $refeicao = $this->refeicaoRepository->find($id);

        if (empty($refeicao)) {
            Flash::error('Refeição não encontrada.');

            return redirect(route('refeicaos.index'));
        }
        
        if($request['habilitada']==0){
            $count = Auxilio::where('refeicao_id',$id)->count();
            Auxilio::where('refeicao_id',$id)->delete();
        }

        $refeicao = $this->refeicaoRepository->update($request->all(), $id);

        Flash::success('Refeição atualizada com sucesso.');

        return redirect(route('refeicaos.index'));
    }

    /**
     * Remove the specified Refeicao from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $refeicao = $this->refeicaoRepository->find($id);

        if (empty($refeicao)) {
            Flash::error('Refeicao not found');

            return redirect(route('refeicaos.index'));
        }

        $this->refeicaoRepository->delete($id);

        Flash::success('Refeicao deleted successfully.');

        return redirect(route('refeicaos.index'));
    }

}
