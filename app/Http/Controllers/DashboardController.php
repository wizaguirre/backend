<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Data;
use App\Gateway;
use App\Person;
use Auth;

class DashboardController extends Controller
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
    public function index(){

        $bySex = $this->graphTotalbyGender();
        $byGateway = $this->graphTotalVisitorsbyGateway(Auth::user()->customer_id);
        $byType = $this->graphTotalbyPeople(Auth::user()->customer_id);

        return view('admin.dashboard')->with('bySex', $bySex)->with('byType', $byType)->with('byGateway', $byGateway);    
    }

    public function graphTotalbyGender(){

        // PIE BY GENDER

        $masculino = \DB::table('data')
                        ->join('people', 'people.id', '=', 'data.people_id')
                        ->select('count', 'people.gender')
                        ->where('people.gender', '=', 'Masculino')
                        ->sum('count');

        $femenino =  \DB::table('data')
                        ->join('people', 'people.id', '=', 'data.people_id')
                        ->select('count', 'people.gender')
                        ->where('people.gender', '=', 'Femenino')
                        ->sum('count');

        $graph = \Charts::create('pie', 'c3')
            ->title('Sexo')
            ->labels(['Masculino', 'Femenino'])
            ->values([$masculino,$femenino])
            ->dimensions(0,500)
            ->responsive(true);
        return $graph;
    }

    public function graphTotalVisitorsbyGateway($customer_id){

        // TOTAL BY GATEWAY

        // Obtener el listado de las puertas por cliente
        $rs = Gateway::all()->where('customer_id', '=', $customer_id);

        $gateways = [];
        foreach ($rs as $gateway) {
            
            $gateways[] = $gateway->name;
        }

        // Obtener el conteo de visitantes por puerta por cliente
        $graph = \Charts::create('line', 'highcharts')
            ->title('Total por Puerta')
            ->elementLabel('Total')
            ->labels($gateways)
            ->values([5,10])
            ->dimensions(0,100)
            ->responsive(true);

        return $graph;
    }

    public function graphTotalbyPeople($customer_id){

        // TOTAL BY PEOPLE

        // Obtener el listado de las puertas por cliente
        $rs = Person::all();

        $people = [];
        foreach ($rs as $person) {
            
            $people[] = $person->name;
        }

        $graph = \Charts::create('bar', 'highcharts')
            ->title('Total por tipo de persona')
            ->elementLabel('Total')
            ->labels($people)
            ->values([12,15,36,22,13,17,8,3])
            ->dimensions(0,100)
            ->responsive(true);

        return $graph;
    }

}
