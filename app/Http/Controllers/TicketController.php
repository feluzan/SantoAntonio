<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Repositories\TicketRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $todayTicket = Ticket::where('assistido_id',$assistido->id)->where('refeicao_id',$refeicao->id)->whereDate('data_refeicao', Carbon::today())->first();
        if($todayTicket!=null){
            Flash::error('Ticket Virtual não gerado. ' . $assistido->name . ' já realizou essa refeição hoje. ');
            return redirect(route('ticket.generate',[$refeicao->id]));
        }

        $input['assistido_id']=$assistido->id;
        $input['data_refeicao'] = Carbon::now("Y-m-d h:i:s");
        $ticket = $this->ticketRepository->create($input);
        Flash::success('Ticket Virtual para  ' . $assistido->name . ' gerado com sucesso.');

        return redirect(route('ticket.generate',[$refeicao->id]));
    }

    public function confirm(CreateTicketRequest $request){
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
        $todayTicket = Ticket::where('assistido_id',$assistido->id)->where('refeicao_id',$refeicao->id)->whereDate('data_refeicao', Carbon::today())->first();
        if($todayTicket!=null){
            Flash::error('Ticket Virtual não gerado. ' . $assistido->name . ' já realizou essa refeição hoje. ');
            return redirect(route('ticket.generate',[$refeicao->id]));
        }

        // $input['assistido_id']=$assistido->id;
        return redirect(route('ticket.confirmview',[$refeicao->id, $assistido->id]));
    }

    public function confirmview(Refeicao $refeicao, User $assistido){
        // dd("confirmview",$refeicao,$assistido);
        return view('tickets.confirm',compact('refeicao','assistido'));
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

    public function generate(Refeicao $refeicao){
        // dd($refeicao);
        return view('tickets.generate',compact('refeicao'));
    }

    public function reportIndex(Request $request){

        $startDate = $request->input('startDate') ? Carbon::create($request->input('startDate')) : Carbon::today()->subDays(30);
        $endDate = $request->input('endDate') ? Carbon::create($request->input('endDate')) : Carbon::today();
        $refeicaoID = $request->input('refeicaoID') ? $request->input('refeicaoID') : 0;
        
        $refeicaoOptions = \App\Models\Refeicao::pluck('nome','id')->toArray();
        array_unshift($refeicaoOptions, 'Todas');
        // dd($refeicaoOptions);
        // dd($refeicaoSelectOptions);
        
        if($refeicaoID>0){
            $tickets = Ticket::whereBetween(DB::raw('date(data_refeicao)'), [$startDate, $endDate])->where('refeicao_id',$refeicaoID)->get();
        }else{
            $tickets = Ticket::whereBetween(DB::raw('date(data_refeicao)'), [$startDate, $endDate])->get();
        }
        

        return view('tickets.reportIndex',compact('startDate','endDate', 'tickets','refeicaoOptions','refeicaoID'));
    }

    public function reportBuild(Request $request){
        
        $startDate = Carbon::create($request->input('startDate'));
        $endDate = Carbon::create($request->input('endDate'));
        $refeicaoID = $request->input('refeicaoID') ? $request->input('refeicaoID') : 0;

        if($refeicaoID>0){
            $items = Ticket::whereBetween(DB::raw('date(data_refeicao)'), [$startDate, $endDate])->where('refeicao_id',$refeicaoID)->get();
            $refeicaoNome = Refeicao::find($refeicaoID)->nome;
        }else{
            $items = Ticket::whereBetween(DB::raw('date(data_refeicao)'), [$startDate, $endDate])->get();
            $refeicaoNome = 'Todas';
        }

        $fields = [
            'refeicao.nome' => 'Refeição',
            'assistido.name' => 'Assistido',
            'emissor.name' => 'Emissor',
            'formatted_value' => 'Valor',
            'formatted_data_refeicao' => 'Emissão'
        ];

        $metaData = [
            'title' => 'Relatório de Tickets Virtuais - Emitido por ' . Auth::user()->name . ' em ' . date('d/m/Y H:i:s'),
            'filter' => 'Data Início: ' . date('d/m/Y', strtotime($startDate)) . ' || ' . 'Data Fim: ' . date('d/m/Y', strtotime($endDate)) . ' || Refeição: ' . $refeicaoNome,
        ];
        // return view('layouts.reportPDF',compact('items','fields'));
        $pdf = PDF::loadView('layouts.tableLandscapePDF',compact('items','fields','metaData'))->setPaper('a4', 'landscape');
        return $pdf->download('[SA]Relatório de Tickets ' . date('dmyHis') . '.pdf');

    }

    public function sumaryIndex(Request $request){
        $startDate = $request->input('startDate') ? Carbon::create($request->input('startDate')) : Carbon::today()->subDays(30);
        $endDate = $request->input('endDate') ? Carbon::create($request->input('endDate')) : Carbon::today();

        $dates = [];
        $looper = $request->input('startDate') ? Carbon::create($request->input('startDate')) : Carbon::today()->subDays(30);
        $fields =[];
        $fields['nome'] = 'Assistido';
        // dd($diff);
        while($looper->diffInDays($endDate)>0){
            $dates[$looper->format('d/m/y')] = 0;
            $fields[$looper->format('d/m/y')] = $looper->format('d/m/y');
            
            $looper = $looper->addDay();
        }
        $dates[$endDate->format('d/m/y')] = 0;
        $fields[$endDate->format('d/m/y')] = $endDate->format('d/m/y');


        $items = [];

        $users = User::has('ticket', '>', 0)->get();

        foreach($users as $u){
            $aux = $dates;
            $aux['nome'] = $u->name;
            $aux['assinatura'] = "________________________________";
            $tickets = Ticket::where('assistido_id',$u->id)->whereBetween(DB::raw('date(data_refeicao)'), [$startDate, $endDate])->get();
            foreach($tickets as $t){
                $aux[$t->data_refeicao->format('d/m/y')]+= $t->valor;
            }
            $items[] = (object)$aux;
        }

        $fields['assinatura'] = 'Assinatura';
       

        return view('tickets.sumaryIndex',compact('startDate','endDate', 'items','fields'));

    }

    public function sumaryBuild(Request $request){
        $startDate = $request->input('startDate') ? Carbon::create($request->input('startDate')) : Carbon::today()->subDays(30);
        $endDate = $request->input('endDate') ? Carbon::create($request->input('endDate')) : Carbon::today();

        $dates = [];
        $datesHas = [];
        $looper = $request->input('startDate') ? Carbon::create($request->input('startDate')) : Carbon::today()->subDays(30);
        $fields =[];
        $fields['nome'] = 'Assistido';
        // dd($diff);
        while($looper->diffInDays($endDate)>0){
            $dates[$looper->format('d/m/y')] = 0;
            $datesHas[$looper->format('d/m/y')] = 0;
            $fields[$looper->format('d/m/y')] = $looper->format('d/m');
            $looper = $looper->addDay();
        }
        $dates[$endDate->format('d/m/y')] = 0;
        $fields[$endDate->format('d/m/y')] = $endDate->format('d/m/y');
        $datesHas[$endDate->format('d/m/y')] = 0;

        $items = [];

        $users = User::has('ticket', '>', 0)->orderBy('name','ASC')->get();
        $totalGlobal = 0;

        $totalByDay = $dates;

        foreach($users as $u){
            $aux = $dates;
            $aux['nome'] = $u->name;
            $aux['assinatura'] = "____________________";
            $aux['total'] = 0;
            $tickets = Ticket::where('assistido_id',$u->id)->whereBetween(DB::raw('date(data_refeicao)'), [$startDate, $endDate])->get();
            foreach($tickets as $t){
                $aux[$t->data_refeicao->format('d/m/y')]+= $t->valor;
                $totalByDay[$t->data_refeicao->format('d/m/y')]+= $t->valor;
                $datesHas[$t->data_refeicao->format('d/m/y')]+=1;
                $aux['total'] += $t->valor;
                
            }
            $items[] = (object)$aux;
            $totalGlobal += $aux['total'];
        }

        $totalByDay['nome'] = "Total Diário";
        $totalByDay['total'] = $totalGlobal;
        $totalByDay['assinatura'] = "";
        $totalByDay['rowExtraClass'] = "soma-geral";
        $items[] = (object)$totalByDay;


        $fields['total'] = 'Total';
        $fields['assinatura'] = 'Assinatura';

        //retirar colunas dos dias que não houveram tickets emitidos
        foreach($datesHas as $key => $value){
            if($value==0){
                unset($fields[$key]);
            }
        }
        

        $metaData = [
            'title' => 'Sumário de Valores por Assistido - Emitido por ' . Auth::user()->name . ' em ' . date('d/m/Y H:i:s'),
            'filter' => 'Data Início: ' . date('d/m/Y', strtotime($startDate)) . ' || ' . 'Data Fim: ' . date('d/m/Y', strtotime($endDate)),
        ];


        $extraStyle=[];
        $extraStyle['td'] = "font-size:10px;text-align:center;";
        $extraStyle['th']="white-space: nowrap;font-size:10px;";
        return view('layouts.tableLandscapePDF',compact('items','fields','metaData','extraStyle','totalGlobal'));
        // $pdf = PDF::loadView('layouts.tableLandscapePDF',compact('items','fields','metaData','extraStyle','totalGlobal'))->setPaper('a4', 'landscape');
        // return $pdf->download('[SA]Sumário de Valores ' . date('dmyHis') . '.pdf');

    }

    public function lancamentoPassado(Request $request){
        $date = $request->input('date') ? Carbon::create($request->input('date')) : Carbon::today()->subDays(1);
        $refeicaoOptions = \App\Models\Refeicao::pluck('nome','id')->toArray();
        return view('tickets.lancamentopassado', compact('date', 'refeicaoOptions'));
    }

    public function pastStore(CreateTicketRequest $request){

        $input = $request->all();

        $date = Carbon::create($input['dateInput']);
        $today = Carbon::today();
        $listaMatriculas = $input['listaMatriculas'];

        // Caso a data passada não seja de dia anterior retorna para a tela de lançamento
        if(!$date->lessThan($today)){
            Flash::error('Você não pode lançar no dia de hoje tickets para o dia ' . $date->format('d/m/Y') . '.');
            $date = $request->input('date') ? Carbon::create($request->input('date')) : Carbon::today()->subDays(1);
            $refeicaoOptions = \App\Models\Refeicao::pluck('nome','id')->toArray();
            return view('tickets.lancamentopassado', compact('date', 'refeicaoOptions', 'listaMatriculas'));
        }

        $refeicao = Refeicao::find($input['refeicao_id']);
        $matriculasArray = preg_split("/\r\n|\n|\r/", $listaMatriculas);
        $log = array();

        foreach($matriculasArray as $matricula){
            $assistido = User::where('username',$matricula)->first();

            if($assistido == null){
                $log[] = array(false,'Ticket Virtual não gerado. ' . $matricula . ' não existe no sistema. ');
                continue;
            }

            //verifica se o $assistido possui o auxilio para a $refeicao
            $auxilio = Auxilio::where('user_id',$assistido->id)->where('refeicao_id',$refeicao->id)->first();
            if($auxilio==null){
                $log[] = array(false,'Ticket Virtual não gerado. ' . $assistido->name . '(' . $assistido->username . ')' . ' não tem auxílio para essa refeição. ');
                continue;
            }

            //verifica se o $assistido já emitiu um ticket para a $refeicao na $date
            $todayTicket = Ticket::where('assistido_id',$assistido->id)->where('refeicao_id',$refeicao->id)->whereDate('data_refeicao', $date)->first();
            if($todayTicket!=null){
                $log[] = array(false,'Ticket Virtual não gerado. ' . $assistido->name . '(' . $assistido->username . ')' . ' já realizou havia realizado essa refeição para o dia ' . $date->format('d/m/Y') . '.');
                continue;
            }

            $input['assistido_id']=$assistido->id;
            $input['data_refeicao'] = $date->format('Y-m-d H:i:s');
            // dd($input['data_refeicao']);
            $input['valor'] = $refeicao->valor;
            $input['emissor_id'] = auth()->user()->id;

            // dd($input);
            $ticket = $this->ticketRepository->create($input);
            $log[] = array(true,'Ticket Virtual para  ' . $assistido->name . '(' . $assistido->username . ')' . ' gerado com sucesso.');
        }

        // return view('tickets.lancamentoPassadoResult',compact('log','refeicao','date'));
        return redirect(route('tickets.lancamentoPassadoResult',['log'=>$log, 'refeicao'=>$refeicao, 'date'=>$date]) );
        // return redirect()->action('TicketController@lancamentoPassadoResult',['log'=>$log, 'refeicao'=>$refeicao, 'date'=>$date]);
        // return redirect(route('tickets.lancamentoPassadoResult',[$log=>$log, $refeicao=>$refeicao, $date=>$date]));
        // return redirect()->route('tickets.lancamentoPassadoResult', ['log'=>$log, 'refeicao'=>$refeicao, 'date'=>$date]);
        // dd($matriculasArray);
    }

    public function lancamentoPassadoResult(Request $request){
        // dd($request->input('log'));
        $log = $request->input('log');
        $refeicao = Refeicao::find($request->input('refeicao'));
        $date = $date = Carbon::create($request->input('date')['date'])->format('d/m/Y');
        // dd($refeicao);
        return view('tickets.lancamentoPassadoResult',compact('log','refeicao','date'));
    }

}