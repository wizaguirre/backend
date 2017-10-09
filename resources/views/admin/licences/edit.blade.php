@extends('layouts.dashboard')

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
                      <h3 class="h4">Editar Licencia</h3>
                    </div>
                    <div class="card-body">
                      <form action="" method="POST">
                      {{ csrf_field() }}
                        <div class="form-group">
                          <label class="form-control-label">Fecha de Inicio</label>
                          <input type="text" name="date_in" id='date_in' class="form-control" value="{{ old('date_in', $licence->date_in) }}">
                        </div>                      
                        <div class="form-group">
                          <label class="form-control-label">Fecha de Fin</label>
                          <input type="text" name="date_end" id='date_end' class="form-control" value="{{ old('date_end', $licence->date_end) }}">
                        </div> 
                        <div class="form-group">
                          <label class="form-control-label">Cliente</label>
                           <select name="customer_id" class="form-control">
                           @foreach($customers as $customer)
                           	@if ($customer->id == $licence->customer->id)
                            	<option value={{ $customer->id }} selected>{{ $customer->name }}</option>
                            @else
                            	<option value={{ $customer->id }}>{{ $customer->name }}</option> 
                            @endif
                            @endforeach
                          </select> 
                        </div>                           
                        <div class="form-group">       
                          <label class="form-control-label">Estado</label>
                          	@if($licence->active == 1)
							    <label class="radio-inline">
							      <input type="radio" name="active" value="1" checked="checked"> Activa
							    </label>
							    <label class="radio-inline">
							      <input type="radio" name="active" value="0"> Inactiva
							    </label>
							@else
							    <label class="radio-inline">
							      <input type="radio" name="active" value="1"> Activa
							    </label>
							    <label class="radio-inline">
							      <input type="radio" name="active" value="0" checked="checked"> Inactiva
							    </label>
							@endif						
                        </div>
                        <div class="form-group">       
                        <input type="submit" value="Actualizar" class="btn btn-primary">
                        </div>
                      </form>
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
