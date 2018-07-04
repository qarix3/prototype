<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $primaryKey = 'id';

    protected $fillable = [
        'icNo',
        'name',
        'address',
        'phoneNo',
        'user_id'
    ];

    protected $dates = ['created_at','updated_at'];

    public $timestamps = false;

    protected $timestamp = true;

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id');
    }

    public function product()
    {
        return $this->hasMany('App\Model\Product','user_id');
    }
}
