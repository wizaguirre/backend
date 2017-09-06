<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Data;

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

        $bySex = \Charts::create('pie', 'c3')
            ->title('Sexo')
            ->labels(['Masculino', 'Femenino'])
            ->values([52,48])
            ->dimensions(0,500)
            ->responsive(true);

        $byGateway = \Charts::create('line', 'highcharts')
            ->title('Total por Puerta')
            ->elementLabel('Total')
            ->labels(['Puerta 1', 'Puerta 2', 'Puerta 3'])
            ->values([5,10,20])
            ->dimensions(0,100)
            ->responsive(true);

        $byType = \Charts::create('bar', 'highcharts')
            ->title('Total por tipo de persona')
            ->elementLabel('Total')
            ->labels(['Anciano Varón', 'Anciano Mujer', 'Adulto varón', 'Adulto Mujer', 'Adolescente varón', 'Adolescente mujer', 'Niño', 'Niña'])
            ->values([12,15,36,22,13,17,8,3])
            ->dimensions(0,100)
            ->responsive(true);

        //return view('admin.dashboard', ['bySex' => $bySex], ['byType' => $byType], ['byGateway' => $byGateway]);
        return view('admin.dashboard')->with('bySex', $bySex)->with('byType', $byType)->with('byGateway', $byGateway);    
    }

}
