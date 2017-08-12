<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;

class RoleController extends Controller
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
        $roles = Role::all();
        return view('admin.roles.index')->with(compact('roles'));
    }

    public function store(Request $request){


    	$rules = [
            'name' => 'required|string|max:255',
    	];

    	$messages = [
    		'name.required' => 'El nombre del rol es obligatorio.',
    		'name.max' =>'El nombre del rol es demasiado largo.',
            'name.string' => 'El nombre solo acepta caracteres alfabeticos.',
    	];

    	$this->validate($request, $rules, $messages);

    	$role = new Role();
    	$role->name = $request->input('name');

    	$role->save();

    	return back()->with('notification', 'El rol ha sido creado con éxito.');    	
    }

    public function edit($id){

    	$role = Role::find($id);
    	return view('admin.roles.edit')->with(compact('role'));
    }

    public function update($id, Request $request){

        $rules = [
            'name' => 'required|string|max:255',
        ];

        $messages = [
            'name.required' => 'El nombre del usuario es obligatorio.',
            'name.max' =>'El nombre de usuario es demasiado largo.',
            'name.string' => 'El nombre solo acepta caracteres alfabeticos.',
        ];

        $this->validate($request, $rules, $messages);

        $role = Role::find($id);
        $role->name = $request->input('name');

        $role->save();

        return back()->with('notification', 'El rol ha sido modificado con éxito.');

    }

    public function delete($id){

        $role = Role::find($id);
        $role->delete();

        return back()->with('notification', 'El rol ha sido eliminado con éxito.');
    }
}
