<?php

namespace App\Repository\Users;


use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable {

    //use Notifiable;
    //use SoftDeletes;

    protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','is_active',
    ];

    public $timestamps = FALSE;
    
    public function notes()
    {
        return $this->hasMany('App\Repository\Notes\Note');
    }
}
