<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'brand',
        'model',
        'part_id',
        'user_id',
    ];

    protected $dates = ['created_at','updated_at'];


    public function parts()
    {
        return $this->hasOne('App\Model\Part','id');
    }

    public function status()
    {
        return $this->hasOne('App\Model\Status','product_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Model\Customer', 'user_id');
    }
}
