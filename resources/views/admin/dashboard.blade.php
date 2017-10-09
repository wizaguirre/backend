@extends('layouts.dashboard')

@section('header')
  {!! Charts::styles() !!}
@endsection

@section('content')
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <div style="display:inline-block;">
                <h2 class="no-margin-bottom">Dashboard</h2>
              </div>
              <div style="display:inline-block; float:right;">
                <form action="" method="POST">
                {{ csrf_field() }}
                  <div class="form-group">
                    <label class="form-control-label">Desde: </label>
                    <input type="text" name="from">
                    <label class="form-control-label">Hasta: </label>
                    <input type="text" name="to">
                    <input type="submit" value="Aplicar">
                  </div>
                </form>
              </div>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <div class="row bg-white has-shadow">      
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fa fa-sign-in"></i></div>
                    <div class="title"><span>Total<br>Puertas</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number">
                      <strong>
                        <?php  
                          use App\Http\Controllers\Api\ApiController;
                          echo count(ApiController::gatewaysByCustomer( Auth::user()->customer_id ));
                        ?>
                      </strong>
                    </div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="fa fa-users"></i></div>
                    <div class="title"><span>Total<br>Visitas</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>
                    </div>
                    <div class="number">
                      <strong>
                        <?php                            
                          echo ApiController::totalVisitorsbyCustomer(Auth::user()->customer_id );
                        ?>
                      </strong>
                    </div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="fa fa-male"></i></div>
                    <div class="title"><span>Total<br>Hombres</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                      </div>
                    </div>
                    <div class="number">
                      <strong>
                        <?php
                          echo ApiController::totalVisitorsbyGender("Masculino");
                        ?>
                      </strong>
                    </div>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-orange"><i class="fa fa-female"></i></div>
                    <div class="title"><span>Total<br>Mujeres</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                      </div>
                    </div>
                    <div class="number">
                      <strong>
                        <?php
                          echo ApiController::totalVisitorsbyGender("Femenino");
                        ?>                        
                      </strong>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <!-- Dashboard Graph    -->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <div class="row bg-white has-shadow">

                <div class="col-sm-12">
                  {!! $byType->html() !!}
                </div>

              </div>  
            </div>
          </section>

          <!-- Dashboard Header Section    -->
          <section class="dashboard-header">
            <div class="container-fluid">
              <div class="row">

                <div class="chart col-lg-6 col-12">
                  <div class="line-chart has-shadow bg-white">
                    {!! $bySex->html() !!}
                  </div>
                </div>

                <div class="chart col-lg-6 col-12">
                  <div class="line-chart has-shadow bg-white">
                    {!! $byGateway->html() !!}
                  </div>
                </div>


              </div>
            </div>
          </section>
@endsection

@section('footer')
  {!! Charts::scripts() !!}
  {!! $bySex->script() !!}
  {!! $byGateway->script() !!}
  {!! $byType->script() !!}  
@endsection
