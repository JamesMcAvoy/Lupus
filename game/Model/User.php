<?php

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $fillable = array(
        'pseudo',
        'token'
    );

    public $timestamps = false;

}
