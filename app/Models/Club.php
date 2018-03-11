<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Club
 * @package App\Models
 * @version March 11, 2018, 7:47 am UTC
 *
 * @property string name
 * @property string city
 * @property string address
 */
class Club extends Model
{

    public $table = 'clubs';
    


    public $fillable = [
        'name',
        'city',
        'address'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'city' => 'string',
        'address' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'city' => 'required',
        'address' => 'required'
    ];

    
}
