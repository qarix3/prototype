<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'productId',
        'brand',
        'model',
    ];

    protected $dates = ['created_at','updated_at'];

    public function customer()
    {
        return $this->hasOne('App\Model\Customer','user_id');
    }
    public function parts()
    {
        return $this->hasMany('App\Model\Part','id');
    }
}
