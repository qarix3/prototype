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


    public function parts()
    {
        return $this->hasMany('App\Model\Part','id');
    }

    public function status()
    {
        return $this->hasOne('App\Model\Status','product_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id');
    }

}
