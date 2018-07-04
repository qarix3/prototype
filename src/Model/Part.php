<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $table = 'repairPart';

    protected $primaryKey ='id';
    public $timestamps = false;

    protected $fillable = [
        'manufacturer',
        'type',
        'price',
    ];
}