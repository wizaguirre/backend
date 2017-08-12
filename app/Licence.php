<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Customer;

class Licence extends Model
{
	use SoftDeletes;

    protected $fillable = [
    	'date_in', 'date_end', 'active'
    ];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }    
}
