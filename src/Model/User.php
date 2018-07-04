<?php

namespace App\Model;

use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser
{
    protected $table = 'user';

    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'email',
        'password',
        'last_name',
        'first_name',
        'permissions',
    ];

    protected $loginNames = ['username', 'email'];

//    public function product()
//    {
//        return $this->hasManyThrough('App\Model\Product', 'App\Model\Customer', 'user_id', 'cust_id', 'id', 'user_id');
//    }
    public function customer()
    {
        return $this->hasOne('App\Model\Customer');
    }
}

