@extends('layouts.app', ['prestador' => $prestador_menu])

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Módulo de Prestaciones.
    
    </h1>

     <div style="padding-top: 15px">
        @include('includes.message')
     </div>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Prestaciones</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPrestacion">
          
          Agregar Prestacion

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Obra Social</th>
           <th>Valor Módulo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

          @foreach ($prestaciones as $key => $prestacion)
           
          <tr>
            <td>{{ ($key+1) }}</td>
            <td>{{ $prestacion->nombre }}</td>
            <td>{{ $prestacion->obrasocial->nombre }}</td>
            <td>{{ $prestacion->valor_modulo }}</td>

            <td>
              <div class="btn-group">
                  
                <button class="btn btn-warning" id="btnEditarPrestacion"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-danger"><i class="fa fa-times"></i></button>

              </div>  

            </td>

          </tr>

          @endforeach

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR PRESTACION
======================================-->

<div id="modalAgregarPrestacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" action="{{ route('prestacion-create') }}">
        @csrf

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Prestacion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <!-- ENTRADA PARA OBRA SOCIAL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select type="text" class="form-control input-lg" name="obra_social" placeholder="Seleccionar Obra Social" required>

                  <option value="">Seleccionar obra social...</option>
                  
                  @foreach ($obras_sociales as $obra_social)
                    <option value="{{ $obra_social->id }}">{{ $obra_social->nombre }}</option>
                  @endforeach

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="prestacion" placeholder="Ingresar Prestacion" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL VALOR -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                <input type="text" class="form-control input-lg" name="valor_prestacion" placeholder="Ingresar Valor de Modulo (si corresponde)">

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Prestacion</button>

        </div>

      </form>

    </div>

  </div>

</div>

@endsection
