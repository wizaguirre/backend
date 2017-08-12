<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\User;
Use App\Role;

class UserController extends Controller
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
        //$users = User::where('role', 1)->get();
        $users = User::all();
        $roles = Role::all();
        return view('admin.users.index')->with(compact('users'))->with(compact('roles'));
    }

    public function store(Request $request){

    	$rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
    	];

    	$messages = [
    		'name.required' => 'El nombre del usuario es obligatorio.',
    		'name.max' =>'El nombre de usuario es demasiado largo.',
            'name.string' => 'El nombre solo acepta caracteres alfabeticos.',
    		'email.required' => 'El Email es obligatorio.',
    		'email.email' => 'El Email ingresado no es válido.',
    		'email.max' => 'El Email es demasiado largo.',
    		'email.unique' => 'El Email ingresado ya se encuentra en uso.',
    		'password.required' => 'La contraseña es obligatorio.',
    		'password.min' => 'La contraseña debe ser almenos de 6 caracteres.',
    	];

    	$this->validate($request, $rules, $messages);

    	$user = new User();
    	$user->name = $request->input('name');
    	$user->email = $request->input('email');
    	$user->password = bcrypt($request->input('password'));
    	$user->role_id = $request->input('role_id');;
    	$user->save();

    	return back()->with('notification', 'El usuario ha sido creado con éxito.');    	
    }

    public function edit($id){

    	$user = User::find($id);
        $roles = Role::all();

    	return view('admin.users.edit')->with(compact('user'))->with(compact('roles'));

    }


    public function update($id, Request $request){

        $rules = [
            'name' => 'required|string|max:255',
            'password' => 'nullable|min:6',
        ];

        $messages = [
            'name.required' => 'El nombre del usuario es obligatorio.',
            'name.max' =>'El nombre de usuario es demasiado largo.',
            'name.string' => 'El nombre solo acepta caracteres alfabeticos.',
            'password.min' => 'La contraseña debe ser almenos de 6 caracteres.',
        ];

        $this->validate($request, $rules, $messages);

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->role_id = $request->input('role_id');
        $password = $request->input('password');
        if($password)
            $user->password = bcrypt($password);

        $user->save();

        return back()->with('notification', 'El usuario ha sido modificado con éxito.');

    }

    public function delete($id){

        $user = User::find($id);
        $user->delete();

        return back()->with('notification', 'El usuario ha sido eliminado con éxito.');
    }
}
