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
        'rrefeicao_id'
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
}
