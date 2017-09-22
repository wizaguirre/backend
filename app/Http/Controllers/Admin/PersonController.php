<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Person;

class PersonController extends Controller
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
        $people = Person::all();
        return view('admin.people.index')->with(compact('people'));
    }

    public function store(Request $request){


    	$rules = [
            'gender' => 'required|string|max:255', 
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
    	];

    	$messages = [
            'gender.required' => 'El género del tipo de persona es obligatorio.',
            'gender.max' =>'El género del tipo de persona es demasiado largo.',
            'gender.string' => 'El género del tipo de persona solo acepta caracteres alfabeticos.',           
    		'name.required' => 'El nombre del tipo de persona es obligatorio.',
    		'name.max' =>'El nombre del tipo de persona es demasiado largo.',
            'name.string' => 'El nombre del tipo de persona solo acepta caracteres alfabeticos.',
            'description.required' => 'La descripción del tipo de persona es obligatorio.',
    		'description.max' =>'La descripción del tipo de persona es demasiado largo.',
            'description.string' => 'La descripción del tipo de persona solo acepta caracteres alfabeticos.',
    	];

    	$this->validate($request, $rules, $messages);

    	$person = new Person();
        $person->gender = $request->input('gender');
    	$person->name = $request->input('name');
    	$person->description = $request->input('description');

    	$person->save();

    	return back()->with('notification', 'El tipo de persona ha sido creado con éxito.');    	
    }

    public function edit($id){

    	$person = Person::find($id);
    	return view('admin.people.edit')->with(compact('person'));
    }

    public function update($id, Request $request){

    	$rules = [
            'gender' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
    	];

    	$messages = [
            'gender.required' => 'El género del tipo de persona es obligatorio.',
            'gender.max' =>'El género del tipo de persona es demasiado largo.',
            'gender.string' => 'El género del tipo de persona solo acepta caracteres alfabeticos.',         
    		'name.required' => 'El nombre del tipo de persona es obligatorio.',
    		'name.max' =>'El nombre del tipo de persona es demasiado largo.',
            'name.string' => 'El nombre del tipo de persona solo acepta caracteres alfabeticos.',
            'description.required' => 'La descripción del tipo de persona es obligatorio.',
    		'description.max' =>'La descripción del tipo de persona es demasiado largo.',
            'description.string' => 'La descripción del tipo de persona solo acepta caracteres alfabeticos.',
    	];

    	$this->validate($request, $rules, $messages);

        $person = Person::find($id);
        $person->gender = $request->input('gender');
        $person->name = $request->input('name');
        $person->description = $request->input('description');        

        $person->save();

        return back()->with('notification', 'El tipo de persona ha sido modificado con éxito.');

    }

    public function delete($id){

        $person = Person::find($id);
        $person->delete();

        return back()->with('notification', 'El tipo de persona ha sido eliminado con éxito.');
    }      
}
