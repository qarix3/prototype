<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $primaryKey = 'icNo';

    protected $fillable = [
        'icNo',
        'name',
        'address',
        'phoneNo',
    ];

    protected $dates = ['created_at','updated_at'];

    public function product()
    {
        return $this->hasMany('App\Model\Product') ;
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id');
    }
}
