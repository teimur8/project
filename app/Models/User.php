<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class User
 * @package App\Models
 * @version March 10, 2018, 4:51 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection clubUser
 * @property \Illuminate\Database\Eloquent\Collection directorWorker
 * @property string name
 * @property dateTime email
 * @property string password
 * @property string role
 */
class User extends Model
{

    public $table = 'users';
    


    public $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'role' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function clubs()
    {
        return $this->belongsToMany(\App\Models\Club::class, 'club_user', 'club_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'director_worker', 'director_id', 'worker_id');
    }

    public function getScheduleAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
