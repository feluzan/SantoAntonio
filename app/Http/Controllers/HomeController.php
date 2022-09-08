<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\Refeicao;
use App\Models\Ticket;
use App\Models\Auxilio;
use Carbon\Carbon;
use Chartjs;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\RefeicaoRepository;

class HomeController extends Controller{

	/** @var  RefeicaoRepository */
	private $refeicaoRepository;

	/** @var  TicketRepository */
	private $ticketRepository;

	/**@var AuxilioRepository */
	private $auxilioRepository;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(TicketRepository $ticketRepo,
								RefeicaoRepository $refeicaoRepo,
								AuxilioRepository $auxilioRepo)
	{
		$this->middleware('auth');
		$this->refeicaoRepository = $refeicaoRepo;
		$this->ticketRepository = $ticketRepo;
		$this->auxilioRepository = $auxilioRepo;
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		$data = [];

		$refeicaos = $this->refeicaoRepository->getAllHabilitadas();

		$charts = [];

		$startDate = Carbon::today()->subDays(7);
		$endDate = Carbon::today();

		foreach($refeicaos as $refeicao){
			$ticketsToday = $this->ticketRepository->getByRefeicaoHoje($refeicao);
			$auxilios = $this->auxilioRepository->getByRefeicao($refeicao);
			$data[$refeicao->nome] = [$ticketsToday,$auxilios, $refeicao];

			$ticketsWeek = DB::table('tickets')
							->selectRaw('count(id) as quantidade_total, date(data_refeicao) dateOnly, sum(valor) valor_total')
							->groupBy('dateOnly')
							->whereBetween(DB::raw('date(data_refeicao)'), [$startDate, $endDate])
							->where('refeicao_id',$refeicao->id)
							->orderBy('dateOnly','ASC')
							->get();

			$dayChart =  app()->chartjs
						->name("dayChart_refeicao_" . $refeicao->id)
						->type('pie')
						->size(['width' => 400, 'height' => 200])
						->labels(['Tickets gerados', 'Auxílios não utilizados'])
						->datasets([
							[
								'backgroundColor' => ['#FF6384', '#36A2EB'],
								'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
								'data' => [count($ticketsToday), count($auxilios)-count($ticketsToday)],
							]
						])
						->optionsRaw([
								'plugins' => [
								  'title' => [
									'display' => true,
									'text' => 'Hoje',
								  ]
								]
						])
						->options([]);

			

			$weekData = [];
			$weekLabels = [];
			for($i = 6; $i>=0; $i-=1){
				$turnDate = Carbon::today()->subDays($i);
				$weekData[$turnDate->format('d-m-Y')] = 0;
				$weekLabels[] = $turnDate->format('d-m-Y');
			}

			foreach($ticketsWeek as $ticket){
				$weekData[date('d-m-Y', strtotime($ticket->dateOnly))] = $ticket->quantidade_total;
			}

			$weekValues = [];
			foreach($weekLabels as $label){
				$weekValues[] = $weekData[$label];
			}

			$weekChart = app()->chartjs
						->name("weekChart_refeicao_" . $refeicao->id)
						->type('line')
						->size(['width' => 400, 'height' => 200])
						->labels($weekLabels)
						->datasets([
							[
								"label" => "Tickets emitidos",
								'backgroundColor' => "rgba(38, 185, 154, 0.31)",
								'borderColor' => "rgba(38, 185, 154, 0.7)",
								"pointBorderColor" => "rgba(38, 185, 154, 0.7)",
								"pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
								"pointHoverBackgroundColor" => "#fff",
								"pointHoverBorderColor" => "rgba(220,220,220,1)",
								'data' => $weekValues,
							],
						])
						->optionsRaw([
							'plugins' => [
							  'title' => [
								'display' => true,
								'text' => 'Últimos 7 dias',
							  ]
							]
						])
						->options([]);

			$charts[$refeicao->nome] = [
				'dayChart' => $dayChart,
				'weekChart' => $weekChart,
			];
		}
		activity("View")->causedBy(Auth::user())->log('Exibindo home.');
		return view('home.home',compact('data', 'charts'));
	}
}
