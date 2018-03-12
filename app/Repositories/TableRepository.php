<?php

namespace App\Repositories;

use App\Models\Table;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TableRepository
 * @package App\Repositories
 * @version March 11, 2018, 10:14 am UTC
 *
 * @method Table findWithoutFail($id, $columns = ['*'])
 * @method Table find($id, $columns = ['*'])
 * @method Table first($columns = ['*'])
*/
class TableRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'club_id',
        'room'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Table::class;
    }
}
