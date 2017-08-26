<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/clientes', 'Api\ApiController@customers');
Route::get('/cliente/{id}', 'Api\ApiController@customerById');

Route::get('/puertas', 'Api\ApiController@gateways');
Route::get('/puertascliente/{id}', 'Api\ApiController@gatewaysByCustomer');

Route::get('/personas', 'Api\ApiController@people');
Route::post('/guardar', 'Api\ApiController@storeData');