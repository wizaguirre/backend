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

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request){

        // Si se recibe el rango de fecha del formulario de Dashboard, se asigna el rango, 
        // sino se muestran con la fecha del día actual.
        if($request->input('from') && $request->input('to')) {

            $from = $request->input('from');
            $to = $request->input('to');

        }
        else {

            $from = date('Y-m-d 00:00:00');
            $to = date('Y-m-d H:m:s');
        }


        $bySex = $this->graphTotalbyGender($from, $to, Auth::user()->customer_id);
        $byGateway = $this->graphTotalVisitorsbyGateway($from, $to, Auth::user()->customer_id);
        $byType = $this->graphTotalbyPeople($from, $to, Auth::user()->customer_id);

        return view('admin.dashboard')->with('bySex', $bySex)->with('byType', $byType)->with('byGateway', $byGateway);    
    }

    public function graphTotalbyGender($from, $to, $customer_id){        

        $masculino = \DB::table('data')
                        ->join('people', 'people.id', '=', 'data.people_id')
                        ->select('count', 'datetime', 'people.gender')
                        ->where([
                                 ['people.gender', '=', 'Masculino'],
                                 ['customer_id', '=', $customer_id]
                        ])
                        ->whereBetween('datetime', [$from, $to])
                        ->sum('count');

        $femenino =  \DB::table('data')
                        ->join('people', 'people.id', '=', 'data.people_id')
                        ->select('count', 'created_at','people.gender')
                        ->where([
                                 ['people.gender', '=', 'Femenino'],
                                 ['data.customer_id', '=', $customer_id]
                        ])
                        ->whereBetween('datetime', [$from, $to])
                        ->sum('count');

        $graph = \Charts::create('pie', 'c3')
            ->title('Sexo')
            ->labels(['Masculino', 'Femenino'])
            ->values([$masculino,$femenino])
            ->dimensions(0,500)
            ->responsive(true);
            
        return $graph;
    }

    public function graphTotalVisitorsbyGateway($from, $to, $customer_id){

        // TOTAL BY GATEWAY
        $query = \DB::table('data')
                    ->join('gateways', 'gateways.id', '=', 'data.gateway_id')
                    ->selectRAW('sum(count) as total, gateways.name')
                    ->where('data.customer_id', '=', $customer_id)
                    ->whereBetween('data.datetime', [$from, $to])                    
                    ->groupBy('gateways.name')                    
                    ->get();

        $gateways = [];
        $totales = [];

        foreach($query as $gateway){
            $gateways[] = $gateway->name;
        }

        foreach($query as $count){
            $totales[] = $count->total;
        }

        // Obtener el conteo de visitantes por puerta por cliente
        $graph = \Charts::create('bar', 'highcharts')
            ->title('Total por Puerta')
            ->elementLabel('Total')
            ->labels($gateways)
            ->values($totales)
            ->dimensions(0,100)
            ->responsive(true);

        return $graph;
    }

    public function graphTotalbyPeople($from, $to, $customer_id){

        // TOTAL BY PEOPLE
        $query = \DB::table('data')
                    ->join('people', 'people.id', '=', 'data.people_id')
                    ->selectRAW('sum(count) as total, people.name')
                    ->where('data.customer_id', '=', $customer_id)
                    ->whereBetween('data.datetime', [$from, $to])                    
                    ->groupBy('people.name')                    
                    ->get();

        $people = [];
        $totales = [];

        foreach($query as $person){
            $people[] = $person->name;
        }

        foreach($query as $count){
            $totales[] = $count->total;
        }

        $graph = \Charts::create('line', 'highcharts')
            ->title('Total por tipo de persona')
            ->elementLabel('Total')
            ->labels($people)
            ->values($totales)
            ->dimensions(0,100)
            ->responsive(true);

        return $graph;
    }

}
