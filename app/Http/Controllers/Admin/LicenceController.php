<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Licence;
use App\Customer;

class LicenceController extends Controller
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
        $licences = Licence::all();
        $customers = Customer::all();
        return view('admin.licences.index')->with(compact('licences'))->with(compact('customers'));
    }

    public function store(Request $request){

        $rules = [
            'date_in' => 'required|date',
            'date_end' => 'required|date',
            'active' => 'required',
            'customer_id' => 'required'
        ];

        $messages = [
            'date_in.required' => 'La fecha de inicio para la vigencia de la licencia es obligatorio.',
            'date_in.date' =>'Debe intriducir un formato de fecha válido en la fecha de inicio.',
            'date_end.required' => 'La fecha de finalización para la vigencia de la licencia es obligatorio.',
            'date_end.date' =>'Debe intriducir un formato de fecha válido en la fecha de finalización.',
            'active.required' => 'El estado de la licencia es obligatorio.',
            'customar_id.required' => 'El cliente es obligatorio.'
        ];

        $this->validate($request, $rules, $messages);

        $licence = new Licence();
        $licence->date_in = $request->input('date_in');
        $licence->date_end = $request->input('date_end');        
        $licence->active = $request->input('active');
        $licence->customer_id = $request->input('customer_id');

        $licence->save();

        return back()->with('notification', 'La licencia ha sido creada con éxito.');        
    }

    public function edit($id){

        $licence = Licence::find($id);
        $customers = Customer::all();

        return view('admin.licences.edit')->with(compact('licence'))->with(compact('customers'));

    }

    public function update($id, Request $request){

        $rules = [
            'date_in' => 'required|date',
            'date_end' => 'required|date',
            'active' => 'required',
            'customer_id' => 'required'
        ];

        $messages = [
            'date_in.required' => 'La fecha de inicio para la vigencia de la licencia es obligatorio.',
            'date_in.date' =>'Debe intriducir un formato de fecha válido en la fecha de inicio.',
            'date_interval_create_from_date_string().required' => 'La fecha de finalización para la vigencia de la licencia es obligatorio.',
            'date_end.date' =>'Debe intriducir un formato de fecha válido en la fecha de finalización.',
            'active.required' => 'El estado de la licencia es obligatorio.',
            'customar_id.required' => 'El cliente es obligatorio.'
        ];

        $this->validate($request, $rules, $messages);

        $licence = Licence::find($id);
        $licence->date_in = $request->input('date_in');
        $licence->date_end = $request->input('date_end');        
        $licence->active = $request->input('active');
        $licence->customer_id = $request->input('customer_id');

        $licence->save();

        return back()->with('notification', 'La licencia ha sido modificada con éxito.');        
    }

    public function delete($id){

        $licence = Licence::find($id);
        $licence->delete();

        return back()->with('notification', 'La licencia ha sido eliminado con éxito.');
    } 
}
