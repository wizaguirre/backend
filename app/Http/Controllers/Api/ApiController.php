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

		// $gateways = \App\Gateway::with('customer')->get();
		// return $gateways;

		$gateways = \DB::table('gateways')
            ->select('gateways.id', 'gateways.name', 'gateways.description', 'customers.name' )
            ->join('customers', 'gateways.customer_id', '=', 'customers.id')
            ->get();

        return $gateways;

	}

	public function gatewaysByCustomer($id){

		// $gateways = \App\Gateway::with('customer')->get();
		// return $gateways;

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

	public function storeData(Request $request){

		$data = new Data();
    	$data->date = $request->input('date');
    	$data->datetime = $request->input('datetime');
    	$data->customer_id = $request->input('customer_id');
    	$data->gateway_id = $request->input('gateway_id');
    	$data->people_id = $request->input('people_id');
    	$data->created_at = date('Y-m-d H:i:s');
    	$data->updated_at = date('Y-m-d H:i:s');

    	$data->save();

	}
}
