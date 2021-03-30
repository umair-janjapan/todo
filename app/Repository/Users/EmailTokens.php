<?php

namespace App\Repository\Users;

use Illuminate\Database\Eloquent\Model;

class EmailTokens extends model {

    protected $table = 'email_tokens';
    protected $primaryKey = 'email_token_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'token',
    ];

    public $timestamps = FALSE;
    
}
