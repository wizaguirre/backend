<?php
use App\User;
use App\Role;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/chart', function () {

$chart = Charts::database(User::all(), 'bar', 'highcharts')
    ->elementLabel("Total")
    ->dimensions(1000, 500)
    ->responsive(false)
    ->groupBy('role_id', null, [1 => 'Administradores', 2 => 'Clientes']);

    return view('test', ['chart' => $chart]);
});


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index');

Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function(){

	// USUARIOS
	Route::get('/seguridad/usuarios', 'UserController@index');
	Route::post('/seguridad/usuarios', 'UserController@store');

	Route::get('/seguridad/usuario/{id}', 'UserController@edit');
	Route::post('/seguridad/usuario/{id}', 'UserController@update');

	Route::get('/seguridad/usuario/{id}/eliminar', 'UserController@delete');

	// ROLES
	Route::get('/seguridad/roles', 'RoleController@index');
	Route::post('/seguridad/roles', 'RoleController@store');

	Route::get('/seguridad/rol/{id}', 'RoleController@edit');
	Route::post('/seguridad/rol/{id}', 'RoleController@update');

	Route::get('/seguridad/rol/{id}/eliminar', 'RoleController@delete');

	// PERSON
	Route::get('/personas', 'PersonController@index');
	Route::post('/personas', 'PersonController@store');

	Route::get('/persona/{id}', 'PersonController@edit');
	Route::post('/persona/{id}', 'PersonController@update');

	Route::get('/persona/{id}/eliminar', 'PersonController@delete');	

	// CUSTOMERS
	Route::get('/clientes', 'CustomerController@index');
	Route::post('/clientes', 'CustomerController@store');

	Route::get('/cliente/{id}', 'CustomerController@edit');
	Route::post('/cliente/{id}', 'CustomerController@update');

	Route::get('/cliente/{id}/eliminar', 'CustomerController@delete');

	// LICENCES
	Route::get('/licencias', 'LicenceController@index');
	Route::post('/licencias', 'LicenceController@store');

	Route::get('/licencia/{id}', 'LicenceController@edit');
	Route::post('/licencia/{id}', 'LicenceController@update');

	Route::get('/licencia/{id}/eliminar', 'LicenceController@delete');

	// GATEWAYS
	Route::get('/accesos', 'GatewayController@index');
	Route::post('/accesos', 'GatewayController@store');

	Route::get('/acceso/{id}', 'GatewayController@edit');
	Route::post('/acceso/{id}', 'GatewayController@update');

	Route::get('/acceso/{id}/eliminar', 'GatewayController@delete');	
});

