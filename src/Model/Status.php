<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    protected $table = 'repairStatus';

    protected $primaryKey ='id';

    protected $fillable = [
        'finished_date',
        'status',
    ];
    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }

}