<?php

namespace App\Repositories;

use App\Models\Auxilio;
use App\Repositories\BaseRepository;

/**
 * Class AuxilioRepository
 * @package App\Repositories
 * @version April 14, 2020, 1:48 pm UTC
*/

class AuxilioRepository extends BaseRepository
{
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'user_id',
		'refeicao_id'
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
		return Auxilio::class;
	}

	public function getByUserRefeicao($user, $refeicao){
		$query = $this->model->newQuery();
		$query->where('user_id',$user->id)
			->where('refeicao_id',$refeicao->id);

		return $query->get()->first();
	}

	public function userHasAuxilio($user, $refeicao){
		$auxilio = $this->getByUserRefeicao($user, $refeicao);
		if ($auxilio==null) return false;
		return true;
	}

	public getByRefeicao($refeicao){
		$query = $this->model->newQuery();
		$query->where('refeicao_id',$refeicao->id);
		return $query->get();
	}
}
