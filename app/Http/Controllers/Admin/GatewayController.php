<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gateway;
use App\Customer;

class GatewayController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gateways = Gateway::orderBy('customer_id')->get();
        $customers = Customer::all();
        return view('admin.gateways.index')->with(compact('gateways'))->with(compact('customers'));
    }

    public function store(Request $request){

        $rules = [
            'name' => 'required|string|max:255',
			'description' => 'required|string|max:255',
            'customer_id' => 'required'
        ];

        $messages = [
            'name.required' => 'El nombre del acceso es obligatorio.',
            'name.string' => 'El nombre del acceso, solo puede contener carácteres alfanuméricos.',
            'name.max' => 'El nombre del acceso es demasiado largo.',
            'description.required' =>'La descripción del acceso es obligatorio.',
            'description.string' => 'La descripción del acceso, solo puede contener carácteres alfanuméricos.',
            'description.max' => 'La descripción del acceso es demasiado largo.',
            'customer_id.required' => 'El cliente es obligatorio.'
        ];

        $this->validate($request, $rules, $messages);

        $gateway = new Gateway();
        $gateway->name = $request->input('name');
        $gateway->description = $request->input('description');        
        $gateway->customer_id = $request->input('customer_id');

        $gateway->save();

        return back()->with('notification', 'El acceso ha sido creado con éxito.');        
    }

    public function edit($id){

        $gateway = Gateway::find($id);
        $customers = Customer::all();

        return view('admin.gateways.edit')->with(compact('gateway'))->with(compact('customers'));

    }

    public function update($id, Request $request){

        $rules = [
            'name' => 'required|string|max:255',
			'description' => 'required|string|max:255',
            'customer_id' => 'required'
        ];

        $messages = [
            'name.required' => 'El nombre del acceso es obligatorio.',
            'name.string' => 'El nombre del acceso, solo puede contener carácteres alfanuméricos.',
            'name.max' => 'El nombre del acceso es demasiado largo.',
            'description.required' =>'La descripción del acceso es obligatorio.',
            'description.string' => 'La descripción del acceso, solo puede contener carácteres alfanuméricos.',
            'description.max' => 'La descripción del acceso es demasiado largo.',
            'customer_id.required' => 'El cliente es obligatorio.'
        ];

        $this->validate($request, $rules, $messages);

        $gateway = Gateway::find($id);
        $gateway->name = $request->input('name');
        $gateway->description = $request->input('description');        
        $gateway->customer_id = $request->input('customer_id');

        $gateway->save();

        return back()->with('notification', 'El acceso ha sido modificado con éxito.');        
    }

    public function delete($id){

        $gateway = Gateway::find($id);
        $gateway->delete();

        return back()->with('notification', 'El acceso ha sido eliminado con éxito.');
    }     
}
