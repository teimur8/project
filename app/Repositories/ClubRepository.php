<?php

namespace App\Repositories;

use App\Models\Club;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ClubRepository
 * @package App\Repositories
 * @version March 11, 2018, 7:47 am UTC
 *
 * @method Club findWithoutFail($id, $columns = ['*'])
 * @method Club find($id, $columns = ['*'])
 * @method Club first($columns = ['*'])
*/
class ClubRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'city',
        'address'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Club::class;
    }
}
