<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Repositories\TicketRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Carbon\Carbon;

use App\Models\Refeicao;
use App\Models\Auxilio;
use App\Models\Ticket;
use App\User;

use PDF;
use DB;

class TicketController extends AppBaseController
{
    /** @var  TicketRepository */
    private $ticketRepository;

    public function __construct(TicketRepository $ticketRepo)
    {
        $this->ticketRepository = $ticketRepo;
    }

    /**
     * Display a listing of the Ticket.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tickets = $this->ticketRepository->all();

        return view('tickets.index')
            ->with('tickets', $tickets);
    }

    /**
     * Show the form for creating a new Ticket.
     *
     * @return Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created Ticket in storage.
     *
     * @param CreateTicketRequest $request
     *
     * @return Response
     */
    public function store(CreateTicketRequest $request)
    {
        $input = $request->all();

        $assistido = User::where('username',$input['username'])->first();
        $refeicao = Refeicao::find($input['refeicao_id']);
        

        //verifica se o $assistido possui o auxilio para a $refeicao
        $auxilio = Auxilio::where('user_id',$assistido->id)->where('refeicao_id',$refeicao->id)->first();
        if($auxilio==null){
            Flash::error('Ticket Virtual não gerado. ' . $assistido->name . ' não tem auxílio para essa refeição. ');
            return redirect(route('ticket.generate',[$refeicao->id]));
        }

        //verifica se o $assistido já emitiu um ticket para a $refeicao na data de hoje
        $todayTicket = Ticket::where('assistido_id',$assistido->id)->where('refeicao_id',$refeicao->id)->whereDate('created_at', Carbon::today())->first();
        if($todayTicket!=null){
            Flash::error('Ticket Virtual não gerado. ' . $assistido->name . ' já realizou essa refeição hoje. ');
            return redirect(route('ticket.generate',[$refeicao->id]));
        }

        $input['assistido_id']=$assistido->id;
        $ticket = $this->ticketRepository->create($input);
        Flash::success('Ticket Virtual para  ' . $assistido->name . ' gerado com sucesso.');

        return redirect(route('ticket.generate',[$refeicao->id]));
    }

    /**
     * Display the specified Ticket.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ticket = $this->ticketRepository->find($id);

        if (empty($ticket)) {
            Flash::error('Ticket not found');

            return redirect(route('tickets.index'));
        }

        return view('tickets.show')->with('ticket', $ticket);
    }

    /**
     * Show the form for editing the specified Ticket.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ticket = $this->ticketRepository->find($id);

        if (empty($ticket)) {
            Flash::error('Ticket not found');

            return redirect(route('tickets.index'));
        }

        return view('tickets.edit')->with('ticket', $ticket);
    }

    /**
     * Update the specified Ticket in storage.
     *
     * @param int $id
     * @param UpdateTicketRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTicketRequest $request)
    {
        $ticket = $this->ticketRepository->find($id);

        if (empty($ticket)) {
            Flash::error('Ticket not found');

            return redirect(route('tickets.index'));
        }

        $ticket = $this->ticketRepository->update($request->all(), $id);

        Flash::success('Ticket updated successfully.');

        return redirect(route('tickets.index'));
    }

    /**
     * Remove the specified Ticket from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ticket = $this->ticketRepository->find($id);

        if (empty($ticket)) {
            Flash::error('Ticket not found');

            return redirect(route('tickets.index'));
        }

        $this->ticketRepository->delete($id);

        Flash::success('Ticket deleted successfully.');

        return redirect(route('tickets.index'));
    }

    public function generate(Refeicao $refeicao){
        // dd($refeicao);
        return view('tickets.generate',compact('refeicao'));
    }

    public function ticketsPeriodo(Request $request){


        $startDate = $request->input('startDate') ? Carbon::create($request->input('startDate')) : Carbon::today()->subDays(30);
        $endDate = $request->input('endDate') ? Carbon::create($request->input('endDate')) : Carbon::today();
        $refeicaoID = $request->input('refeicaoID') ? $request->input('refeicaoID') : 0;
        
        $refeicaoOptions = \App\Models\Refeicao::pluck('nome','id')->toArray();
        array_unshift($refeicaoOptions, 'Todas');
        // dd($refeicaoOptions);
        // dd($refeicaoSelectOptions);
        
        if($refeicaoID>0){
            $tickets = Ticket::whereBetween(DB::raw('date(created_at)'), [$startDate, $endDate])->where('refeicao_id',$refeicaoID)->get();
        }else{
            $tickets = Ticket::whereBetween(DB::raw('date(created_at)'), [$startDate, $endDate])->get();
        }
        

        return view('tickets.periodo',compact('startDate','endDate', 'tickets','refeicaoOptions','refeicaoID'));
    }



    public function reportBuild(Request $request){
        
        $startDate = Carbon::create($request->input('startDate'));
        $endDate = Carbon::create($request->input('endDate'));
        $refeicaoID = $request->input('refeicaoID') ? $request->input('refeicaoID') : 0;

        if($refeicaoID>0){
            $items = Ticket::whereBetween(DB::raw('date(created_at)'), [$startDate, $endDate])->where('refeicao_id',$refeicaoID)->get();
            $refeicaoNome = Refeicao::find($refeicaoID)->nome;
        }else{
            $items = Ticket::whereBetween(DB::raw('date(created_at)'), [$startDate, $endDate])->get();
            $refeicaoNome = 'Todas';
        }

        


        $fields = [
            'refeicao.nome' => 'Refeição',
            'assistido.name' => 'Assistido',
            'emissor.name' => 'Emissor',
            'formatted_value' => 'Valor',
            'formatted_created_at' => 'Emissão'
        
        ];

        $metaData = [
            'title' => 'Relatório de Tickets Virtuais',
            'filter' => 'Data Início: ' . date('d/m/Y', strtotime($startDate)) . ' || ' . 'Data Fim: ' . date('d/m/Y', strtotime($endDate)) . ' || Refeição: ' . $refeicaoNome,
        ];
        // return view('layouts.reportPDF',compact('items','fields'));
        $pdf = PDF::loadView('layouts.tableLandscapePDF',compact('items','fields','metaData'))->setPaper('a4', 'landscape');
        return $pdf->download('[SA]Relatório de Tickets.pdf');

    }

}