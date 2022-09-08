<?php

namespace App\Repositories;

use App\Models\Refeicao;
use App\Repositories\BaseRepository;

/**
 * Class RefeicaoRepository
 * @package App\Repositories
 * @version April 13, 2020, 1:37 pm UTC
*/

class RefeicaoRepository extends BaseRepository
{
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'nome',
		'inicio',
		'fim',
		'valor',
		'habilitada'
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
		return Refeicao::class;
	}


	public function getAllHabilitadas(){
		$query = $this->model->newQuery();
		$query->where('habilitada',1);
		return $query->get();
	}
}
