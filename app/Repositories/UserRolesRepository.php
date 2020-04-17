<?php

namespace App\Repositories;

use App\Models\UserRoles;
use App\Repositories\BaseRepository;

/**
 * Class UserRolesRepository
 * @package App\Repositories
 * @version April 9, 2020, 6:32 pm UTC
*/

class UserRolesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
        return UserRoles::class;
    }
}
