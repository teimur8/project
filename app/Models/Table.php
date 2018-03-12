<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Table
 * @package App\Models
 * @version March 11, 2018, 10:14 am UTC
 *
 * @property string name
 * @property integer club_id
 * @property string room
 */
class Table extends Model
{

    public $table = 'tables';



    public $fillable = [
        'name',
        'club_id',
        'room'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'club_id' => 'integer',
        'room' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'club_id' => 'required',
        'room' => 'required'
    ];


    public function club()
    {
        return $this
            ->belongsTo(Club::class, 'club_id', 'id')
            ->select('id', 'name', 'city', 'address');
    }


}
