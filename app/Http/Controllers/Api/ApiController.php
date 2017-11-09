<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Gateway;
use App\Person;
use App\Data;

class ApiController extends Controller
{
    public function customers(){

		$customers = \App\Customer::all();
		return $customers;
	}

    public function customerById($id){

    	$customer = Customer::find($id);
		return $customer;
	}	

	public function gateways(){

		$gateways = \DB::table('gateways')
            ->select('gateways.id', 'gateways.name', 'gateways.description', 'customers.name' )
            ->join('customers', 'gateways.customer_id', '=', 'customers.id')
            ->get();

        return $gateways;

	}

	public static function gatewaysByCustomer($id){

		$gateways = \DB::table('gateways')
            ->select('gateways.id', 'gateways.name', 'gateways.description', 'customers.name' )
            ->join('customers', 'gateways.customer_id', '=', 'customers.id')
            ->where('customers.id', $id)
            ->get();

        return $gateways;

	}

	public function people(){

		$people = \App\Person::all();
		return $people;
	}

	public static function totalVisitorsbyCustomer($id){
		 
		 $data = \DB::table('data')
		 			->where('customer_id', '=', $id)
		 			->sum('count');
		 			
		 return $data;
		 
	}

	public static function totalVisitorsbyGender($gender){

		$data = \DB::table('data')
		            ->join('people', 'people.id', '=', 'data.people_id')
		            ->select('count', 'people.gender')
		            ->where([
		            	['people.gender', '=', $gender],
		            	
		            ])
		            ->sum('count');
		return $data;

	}

	public function storeData(Request $request){

		$data = new Data();
    	$data->date = $request->input('date');
    	$data->datetime = $request->input('datetime');
    	$data->customer_id = $request->input('customer_id');
    	$data->gateway_id = $request->input('gateway_id');
    	$data->people_id = $request->input('people_id');
    	$data->count = $request->input('count');
    	$data->created_at = date('Y-m-d H:i:s');
    	$data->updated_at = date('Y-m-d H:i:s');

    	$data->save();

		return response()->json([
		    'Status' => 'OK',
		    'Mensaje' => 'Registro guardado con éxito'
		], 200);
       

	}
}
