<?php

namespace App\Repositories;

use App\Models\PermissaoAcesso;
use App\Repositories\BaseRepository;

/**
 * Class PermissaoAcessoRepository
 * @package App\Repositories
 * @version October 13, 2021, 3:30 pm -03
*/

class PermissaoAcessoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'codigo'
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
        return PermissaoAcesso::class;
    }
}
