<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;

class CustomerController extends Controller
{
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
        $customers = Customer::all();
        return view('admin.customers.index')->with(compact('customers'));
    }

    public function store(Request $request){


    	$rules = [
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'email' => 'required|email|max:50',
            'phone' => 'required|digits:8',
            'address' => 'required|string|max:400'

    	];

    	$messages = [
    		'name.required' => 'El nombre del cliente es obligatorio.',
    		'name.max' =>'El nombre del cliente es demasiado largo.',
            'name.string' => 'El nombre del cliente solo acepta caracteres alfabeticos.',
            'contact.required' => 'El nombre de la persona de contacto es obligatorio.',
    		'contact.max' =>'El nombre de la persona de contacto es demasiado largo.',
            'contact.string' => 'El nombre de la persona de contacto solo acepta caracteres alfabeticos.',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'Debe introducir un email válido.',
            'email.max' => 'El email es demasiado largo.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.digits' => 'El teléfono debe ser máximo de 8 dígitos.',
            'address.required' => 'La dirección física de la empresa es obligatorio.',
            'address.max' => 'La dirección es demasiado larga.'
    	];

    	$this->validate($request, $rules, $messages);

    	$customer = new Customer();
    	$customer->name = $request->input('name');
    	$customer->contact = $request->input('contact');
    	$customer->email = $request->input('email');
    	$customer->phone = $request->input('phone');
    	$customer->address = $request->input('address');    	 		

    	$customer->save();

    	return back()->with('notification', 'El cliente ha sido creado con éxito.');    	
    }

    public function edit($id){

    	$customer = Customer::find($id);
    	return view('admin.customers.edit')->with(compact('customer'));
    }

    public function update($id, Request $request){

    	$rules = [
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'email' => 'required|email|max:50',
            'phone' => 'required|digits:8',
            'address' => 'required|string|max:400'

    	];

    	$messages = [
    		'name.required' => 'El nombre del cliente es obligatorio.',
    		'name.max' =>'El nombre del cliente es demasiado largo.',
            'name.string' => 'El nombre del cliente solo acepta caracteres alfabeticos.',
            'contact.required' => 'El nombre de la persona de contacto es obligatorio.',
    		'contact.max' =>'El nombre de la persona de contacto es demasiado largo.',
            'contact.string' => 'El nombre de la persona de contacto solo acepta caracteres alfabeticos.',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'Debe introducir un email válido.',
            'email.max' => 'El email es demasiado largo.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.digits' => 'El teléfono debe ser máximo de 8 dígitos.',
            'address.required' => 'La dirección física de la empresa es obligatorio.',
            'address.max' => 'La dirección es demasiado larga.'
    	];

    	$this->validate($request, $rules, $messages);

        $customer = Customer::find($id);
        $customer->name = $request->input('name');
        $customer->contact = $request->input('contact');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->address = $request->input('address');             

        $customer->save();

        return back()->with('notification', 'El cliente ha sido modificado con éxito.');

    }

    public function delete($id){

        $customer = Customer::find($id);
        $customer->delete();

        return back()->with('notification', 'El cliente ha sido eliminado con éxito.');
    }      
}
