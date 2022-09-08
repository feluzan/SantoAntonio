<?php

namespace App\Repositories;
use DB;
use App\Models\Ticket;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

/**
 * Class TicketRepository
 * @package App\Repositories
 * @version April 13, 2020, 4:13 pm UTC
*/

class TicketRepository extends BaseRepository
{
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'refeicao_id',
		'assistido_id',
		'emissor_id',
		'valor',
		'data_refeicao',
		
	];

	/**
	 * Return searchable fields
	 *
	 * @return array
	 */
	public function getFieldsSearchable()
	{
		return $this->fieldSearchable;
	}

	/**
	 * Configure the Model
	 **/
	public function model()
	{
		return Ticket::class;
	}

	public function allBetweenDatesQuery($startDate, $endDate){
		$query = $this->model->newQuery();
		$query->whereBetween(DB::raw('date(data_refeicao)'),[$startDate,$endDate]);
		return $query;
	}

	public function allBetweenDates($startDate, $endDate){
		return $this->allBetweenDatesQuery($startDate, $endDate)->get();
	}

	public function sumaryTicketsBetweenDates($startDate, $endDate){
		//SELECT assistido_id, refeicao_id, count(*), sum(valor) FROM dev_santoantonio.tickets group by refeicao_id, assistido_id;
		$query = $this->model->newQuery();
		$query->selectRaw('assistido_id, refeicao_id, count(*) as quantidade, sum(valor) as valor')
			->groupBy('refeicao_id','assistido_id')
			->whereBetween(DB::raw('date(data_refeicao)'),[$startDate,$endDate]);
		
		return $query->get();
	}

	public function getByAssistidoRefeicaoHoje($assistido, $refeicao){
		$query = $this->model->newQuery();
		$query->where('assistido_id',$assistido->id)
			->where('refeicao_id',$refeicao->id)
			->whereDate('data_refeicao', Carbon::today())->first();

		return $query->get()->first();
	}

	public function getByRefeicaoHoje($refeicao){

		$query = $this->model->newQuery();
		$query->where('refeicao_id',$refeicao->id)
			->whereDate('data_refeicao', Carbon::today());

		return $query->get();

	}


}
