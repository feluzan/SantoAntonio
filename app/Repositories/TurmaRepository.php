<?php

namespace App\Repositories;

use App\Models\Turma;
use App\Repositories\BaseRepository;

/**
 * Class TurmaRepository
 * @package App\Repositories
 * @version October 26, 2021, 10:57 am -03
*/

class TurmaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'curso'
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
        return Turma::class;
    }
}
