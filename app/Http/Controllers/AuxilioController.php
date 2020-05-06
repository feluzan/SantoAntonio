<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuxilioRequest;
use App\Http\Requests\UpdateAuxilioRequest;
use App\Repositories\AuxilioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flash;
use Response;
use PDF;

use App\User;
use App\Models\Refeicao;
use App\Models\Auxilio;

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

        // $users = User::with('Auxilio')->get();
        // foreach($users as $u){
        //     dd($u->auxilio);
        // }

        // dd($auxilios);
        $input = $request->all();
        if(isset($input['search'])){
            $searchTerm = $input['search'];
            $users = User::query()
                        ->where('name', 'LIKE', "%{$searchTerm}%") 
                        ->orWhere('username', 'LIKE', "%{$searchTerm}%") 
                        ->get();
        }else{
            $users = User::all();
        }
        // dd($users);
        // $auxilios = $this->auxilioRepository->all();
        return view('auxilios.index')
            ->with('users', $users);
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

        Flash::success('Auxilio salvo com sucesso.');

        return redirect(route('auxilios.manage',[$input['user_id']]));
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
        $user_id = $auxilio->user_id;
        // dd($user_id);

        if (empty($auxilio)) {
            Flash::error('Auxilio not found');

            return redirect(route('auxilios.index'));
        }

        $this->auxilioRepository->delete($id);

        Flash::success('Auxilio deletado com sucesso.');

        return redirect(route('auxilios.manage', [$user_id]));
    }

    public function manage(User $user){

        
        $refeicoes = Refeicao::all();
        // dd($user->auxilio);
        // dd($user, $refeicoes);
        return view('auxilios.individual', compact('user', 'refeicoes'));
    }

    public function reportBuild(Request $request){

        $users = User::has('auxilio', '>', 0)->get();
        $refeicaos = Refeicao::all();

        $auxRefeicaos = [];
        $fields =[];
        $fields['nome'] = 'Assistido';
        foreach($refeicaos as $r){
            $fields[$r->nome] = $r->nome;
            $auxRefeicaos[$r->nome] = "Não assistido";
        }
        $items = [];

        foreach($users as $u){
            $aux = $auxRefeicaos;
            $aux['nome'] = $u->name;
            foreach($u->auxilio as $auxilio){
                $aux[$auxilio->refeicao->nome] = "Assistido";
            }
            $items[] = (object)$aux;
        }

        $metaData = [
            'title' => 'Relatório de Auxílios - Emitido por ' . Auth::user()->name . ' em ' . date('d/m/Y H:i:s'),
            'filter' => '',
        ];
        // return view('layouts.reportPDF',compact('items','fields'));
        $pdf = PDF::loadView('layouts.tableLandscapePDF',compact('items','fields','metaData'))->setPaper('a4', 'landscape');
        return $pdf->download('[SA]Relatório de Auxílios ' . date('dmyHis') . '.pdf');

    }
}
