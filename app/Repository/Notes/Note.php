<?php

namespace App\Repository\Notes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Note extends model {

    use SoftDeletes;
    protected $table = 'notes';
    protected $primaryKey = 'note_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public $timestamps = TRUE;


    public function excerpt(){

        return Str::limit($this->description, 255);
    }


    public function user(){

        return $this->belongsTo('App\Repository\Users\User', 'created_by');
    }
    
}
