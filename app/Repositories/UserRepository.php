<?php

namespace App\Repositories;

use App\User;
use App\Repositories\BaseRepository;

/**
 * Class UserRolesRepository
 * @package App\Repositories
 * @version April 9, 2020, 6:32 pm UTC
*/

class UserRepository extends BaseRepository
{
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'arquivado',
		'name',
		'username',
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
		return User::class;
	}


	public function allArchived($searchTerms = [], $likeTerms = []){
		$searchTerms["arquivado"] = true;
		
		return $this->all($searchTerms);
	}

	public function allNotArchived($searchTerms = []){
		$searchTerms["arquivado"] = false;
		
		return $this->all($searchTerms);
	}

	public function findByUsername($username){
		$query = $this->model->newQuery();
		$query->where('username',$username);
		return $query->get()->first();
	}

	public function allOrderedByName($arquivado = false){
		$query = $this->model->newQuery();
		$query->where('arquivado',$arquivado);
		$query->orderBy('name','ASC');
		return $query->get();
	}
}
