<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $primaryKey = 'staffId';

    protected $fillable = [
        'name',
        'phoneNo',
        'address',
        'jobId',
];

    protected $dates = ['created_at','updated_at'];
}
