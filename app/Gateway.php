<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Customer;

class Gateway extends Model
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

    public function customer(){
    	return $this->belongsTo('App\Customer');
    }
}
