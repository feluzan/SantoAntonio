<?php

namespace App\Repositories;

use App\Models\Documento;
use App\Repositories\BaseRepository;

/**
 * Class DocumentoRepository
 * @package App\Repositories
 * @version March 30, 2021, 2:43 pm -03
*/

class DocumentoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'path',
        'nome',
        'descricao',
        'data_autenticacao',
        'autenticador_id',
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
        return Documento::class;
    }
}
