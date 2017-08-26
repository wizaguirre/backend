<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{

	use SoftDeletes;

    protected $fillable = [
    	'name', 
    	'contact', 
    	'email', 
    	'phone', 
    	'address'
    ];

    protected $hidden = [
    	'deleted_at', 
    	'created_at', 
    	'updated_at'
    ];

}
