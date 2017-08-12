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

    public function customer(){
    	return $this->belongsTo('App\Customer');
    }
}
