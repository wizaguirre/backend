<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{

	use SoftDeletes;

    protected $fillable = [
    	'name', 'description'
    ];

    protected $hidden = [
    	'deleted_at', 
    	'created_at', 
    	'updated_at'
    ];     
}
