@extends('layouts.app', ['prestador' => $prestador_menu])

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
     Datos de prestador - <span><small>{{ Auth::user()->name . ' ' . Auth::user()->surname}}</small></span>
    
    </h1>

      <div style="padding-top: 15px">
        @include('includes.message')
     </div>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Datos de Prestador</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPrestacion">
          
          Agregar datos de prestador

        </button>
  
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Obra Social</th>
           <th>Numero de Prestador</th>
           <th>Prestacion</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

          @if($prestador != null)
            @foreach($prestador as $key=>$prestacion)
            
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $prestacion->obrasocial[0]->nombre }}</td>
              <td>{{ $prestacion->numero_prestador }}</td>
              <td>{{ $prestacion->prestacion }}</td>
              <td>
                <div class="btn-group">
                    
                  <button class="btn btn-warning btnEditarPrestacion" data-toggle="modal" data-target="#modalEditarPrestacion" idPrest="{{ $prestacion->id }}"><i class="fa fa-pencil"></i></button>

                </div>  

              </td>

            </tr>

            @endforeach
          @endif

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR PRESTACION
======================================-->

<div id="modalAgregarPrestacion" tabindex="-1" aria-hidden="true" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="POST" action="{{ route('prestador-create') }}">
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

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-12">
              
              <div class="input-group col-lg-12">

                <div class="col-lg-6">

                    <label for="obraSocial">Obra Social</label>

                    <select type="text" class="form-control input-lg" name="obraSocial" required>
                      
                      @foreach($obrasocial as $obra)
        
                        <option value="{{ $obra->id }}">{{ $obra->nombre }}</option>

                      @endforeach

                    </select>

                </div>
              
                <div class="col-lg-6">

                      <label for="numeroPrestador">Número de Prestador</label>

                      <input type="text" class="form-control input-lg" name="numeroPrestador" placeholder="Ingresar numero" required>

                </div>

                   @if(Auth::user()->role == "Prestador")
                    <div class="col-lg-12 mt-2">
                        <label for="role_profesion">{{ __('Profesion') }}</label>

                            <select id="role_profesion" type="text" class="form-control @error('role_profesion') is-invalid @enderror" name="profesion" value="{{ old('role_profesion') }}" autocomplete="profesion" autofocus>
                              <option value="">Seleccionar...</option>
                               @foreach($prestaciones as $prestacion)
                                  <option value="{{ $prestacion->nombre }}">{{ $prestacion->nombre }}</option>
                               @endforeach
                            </select>

                            @error('role_profesion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                @elseif(Auth::user()->role == "Institucion")
                  <div class="col-lg-12 mt-2">
                    <label for="role_instit">{{ __('Institucion') }}</label>

                        <select id="role_institucion" type="text" class="form-control @error('role_instit') is-invalid @enderror" name="profesion" value="{{ old('role_institucion') }}" autocomplete="profesion" autofocus>
                            <option value="">Seleccionar Tipo de Institucion</option>
                            <option value="Institucion de rehabilitacion">Institucion de rehabilitacion</option>
                            <option value="Institucion de rehabilitacion e integracion escolar">Institucion de rehabilitacion e integracion escolar</option>
                            <option value="Institucion con internacion de pacientes">Institucion con internacion de pacientes</option>
                        </select>

                        @error('role_institucion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>

                @elseif(Auth::user()->role == "Traslado")
                  <div class="col-lg-12 mt-2">
                    <label for="role_traslado">{{ __('Traslado') }}</label>

                        <select id="role_traslado" type="text" class="form-control @error('role_traslado') is-invalid @enderror" name="profesion" value="{{ old('role_traslado') }}" autocomplete="profesion" autofocus>
                            <option value="">Seleccionar Tipo de Traslado</option>
                            <option value="Traslado a rehabilitacion">Traslado a rehabilitacion</option>
                            <option value="Traslado a Institutos Educativo">Traslado a Institutos Educativo</option>
                            <option value="Traslado a Instituto de Rehabilitacion">Traslado a Instituto de Rehabilitacion</option>
                        </select>

                        @error('role_institucion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>

                @endif

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar datos</button>

        </div>

      </form>

    </div>

  </div>

</div>

{{-- Editar prestacion --}}
<div id="modalEditarPrestacion" tabindex="-1" aria-hidden="true" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="POST" action="{{ route('prestador-update') }}">
        @csrf

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Prestacion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-12">
              
              <div class="input-group col-lg-12">
              
                <div class="col-lg-6">

                      <label for="editarNumeroPrestador">Editar número de Prestador</label>

                      <input type="text" class="form-control input-lg" name="editarNumeroPrestador" id="editarNumeroPrestador" placeholder="Ingresar numero" required>

                </div>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar datos</button>

        </div>

        <input type="hidden" name="id" id="id">

      </form>

    </div>

  </div>

</div>



@endsection
