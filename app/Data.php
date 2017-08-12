<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Data extends Model
{
	use SoftDeletes;

    protected $fillable = [
    	'date','datetime', 'customer_id', 'gateway_id', 'people_id'
    ];
}
