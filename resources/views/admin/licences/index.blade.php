@extends('layouts.dashboard')

@section('header')
	<link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
@endsection

@section('content')
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Licencias</h2>
            </div>
          </header>
          <!-- Breadcrumb-->
          <ul class="breadcrumb">
            <div class="container-fluid">
              <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
              <li class="breadcrumb-item active">Licencias</li>
            </div>
          </ul>
          <section class="tables">   
            <div class="container-fluid">
            <div class="panel-body">
              @if (session('notification'))
                <div class="alert alert-success">
                  {{ session('notification') }}
                </div>
              @endif

            @if (count($errors) > 0 )
              <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
              </div>
            @endif
            </div>
              <div class="row">              
                <div class="col-lg-12">               
                  <div class="card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Cerrar</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Editar</a></div>
                      </div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Agregar Licencia</h3>
                    </div>
                    <div class="card-body">
                      <form action="" method="POST">
                      {{ csrf_field() }}
                        <div class="form-group">
                          <label class="form-control-label">Fecha de Inicio</label>
                          <input type="text" name="date_in" id='date_in' class="form-control" value="{{ old('date_in') }}">
                        </div>                      
                        <div class="form-group">
                          <label class="form-control-label">Fecha de Fin</label>
                          <input type="text" name="date_end" id='date_end' class="form-control" value="{{ old('date_end') }}">
                        </div> 
                        <div class="form-group">
                          <label class="form-control-label">Cliente</label>
                           <select name="customer_id" class="form-control">
                           @foreach($customers as $customer)
                            <option value={{ $customer->id }}>{{ $customer->name }}</option>
                            @endforeach
                          </select> 
                        </div>                           
                        <div class="form-group">       
                          <label class="form-control-label">Estado</label>
							<div >
						    <label class="radio-inline">
						      <input type="radio" name="active" value="1"> Activa
						    </label>
						    <label class="radio-inline">
						      <input type="radio" name="active" value="0"> Inactiva
						    </label>						    
						    </div>
                        </div>
                        <div class="form-group">       
                          <input type="submit" value="Guardar" class="btn btn-primary">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">              
                <div class="col-lg-12">               
                  <div class="card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Cerrar</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Editar</a></div>
                      </div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Listado de Licencias</h3>
                    </div>
                    <div class="card-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Estado</th>                            
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i =1 ?>
                          @foreach($licences as $licence)
                          <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $licence->customer->name }}</td>
                            <td>{{ Carbon\Carbon::parse($licence->date_in)->format('d-m-Y') }}</td>
                            <td>{{ Carbon\Carbon::parse($licence->date_end)->format('d-m-Y') }}</td>
                            <td>
                            	@if ($licence->active == 1)
                            		<span id='licencia_activa'><i class="fa fa-thumbs-o-up"></i> Activa</span>
                            	@else
                            		<span id='licencia_inactiva'><i class="fa fa-thumbs-o-down"></i> Inactiva</span>
                            	@endif                            	
                            </td>                            
                            <td>
                                <a href="/licencia/{{ $licence->id }}" class="btn btn-sm btn-primary" title="Editar">
                                  <i class="fa fa-pencil"></i>
                                </a>
                                <a href="/licencia/{{ $licence->id }}/eliminar" class="btn btn-sm btn-danger" title="Eliminar">
                                  <i class="fa fa-trash"></i>
                                </a>                                
                            </td>
                          </tr>
                          <?php $i++ ?>
                        @endforeach                        
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </section>
         
@endsection

@section('footer')
	<script src="{{ asset('js/bootstrap-datepicker.js')}}"></script>
	  <script>
	  // Fecha inicio vigencia licencia
	  $(function() {
	    $( "#date_in" ).datepicker({
		    isRTL: false,
		    format: 'yyyy-mm-dd',
		    autoclose:true
		});
	  });

	  // Fecha fin vigencia licencia
	  $(function() {
	    $( "#date_end" ).datepicker({
		    isRTL: false,
		    format: 'yyyy-mm-dd',
		    autoclose:true
		});
	  });	  
	  </script> 
@endsection
