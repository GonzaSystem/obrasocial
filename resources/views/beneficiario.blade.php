@extends('layouts.app', ['prestador' => $data['prestador_menu']])
<style>
  .dataTables_filter {
     display: none;
  }

  .select2-container.select2-container--default {
	  width: 100% !important;
  }

  .select2-selection__choice {
	  background: #605CA8 !important;
  }
</style>
@section('content')

@php

	$meses = ['01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'];

@endphp


<div class="content-wrapper">

  <section class="content-header">

    <h1>
          Módulo de beneficiarios - {{ $data['obrasocial'][0]->nombre }} <br>
          <h4>
            Prestador: {{ Auth::user()->name . ' ' . Auth::user()->surname }}
		  </h4>
    </h1>

     <div style="padding-top: 15px">
        @include('includes.message')
     </div>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Beneficiarios</li>

    </ol>

  </section>

  <section class="content">
  
  <div class="form-group">
    <div class="row" style="display: inline-flex; margin-left: 0;">
    <div class="input-group">
      <label for="mes">Mes</label>
      <select type="text" name="mes" class="form-control input-md selectMes" idOs="{{ $data['obrasocial'][0]->id}}" idPrest="{{ Auth::user()->id }}">
          @foreach($meses as $mes => $nombre)
              <option value="{{ $mes }}" {{ $mes == Auth::user()->mes ? 'selected' : '' }}>{{ $nombre }}</option>
          @endforeach
      </select>
    </div>

    <div class="input-group" style="margin-left: 10px">
      <label for="anio">Año</label>
      <select type="text" name="anio" class="form-control input-md selectAnio">
          <option value="2019">2019</option>
          <option value="2020" selected>2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
      </select>
    </div>
    </div>
  </div>

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" style="margin-right: 15px; {{Auth::user()->mes != date('m') || Auth::user()->anio != date('Y') ? 'display:none' : ''}}" data-toggle="modal" data-target="#modalAgregarBeneficiario">

          Agregar Beneficiario

        </button>

          Buscar: <input type="text" id="searchbox">

      </div>

      <div class="box-body">

      @if($data['obrasocial'][0]->nombre == "APROSS")

         <table class="table table-bordered table-striped dt-responsive tablaBeneficiario">

          <thead>

           <tr>

             <th style="text-align: center">Clonar</th>
             <th>Apellido y Nombre</th>
             <th style="text-align: center">N° de Beneficiario</th>
             <th style="text-align: center">Cod. Seguridad</th>
             <th style="text-align: center">Cod. Modulo</th>
             <th style="text-align: center; width: 30px">Cant. Solicitada</th>
             <th>Observaciones</th>
             <th style="text-align: center">Cod. Traditum</th>
             <th>Acciones</th>

           </tr>

          </thead>

          <tbody>

          @foreach($data['beneficiarios'] as $beneficiario)

              <?php 
                  $codigo_prestacion = $beneficiario->prestacion[0]->codigo_modulo;
                  $planilla = $beneficiario->prestacion[0]->planilla;
                  $os_id = $beneficiario->os_id;
                  $prestador_id = $beneficiario->id;
              ?>

			@foreach($beneficiario->beneficiario as $key => $benefval)
			
            <tr style="{{ (Session::has('ModificacionBeneficiario') && Session::get('ModificacionBeneficiario') == $benefval->id) ? 'font-weight:bold;' : ''}}">
				<td style="text-align: center"> <button class="btn btn-success btnClonarBeneficiario" data-toggle="modal" data-target="#modalClonarBeneficiario" idBenef="{{ $benefval->id }}"><i class="fa fa-users"></i></button></td>
					@if($data['obrasocial'][0]->nombre == "OSECAC")
						<td style="text-align: center"><a href="{{ route('beneficiario-presupuesto', ['prestador_id' => $benefval->prestador_id, 'beneficiario_id' => $benefval->id]) }}" target="_BLANK"><button class="btn btn-success">8.4</button></a></td>
					@endif
				<td>{{ $benefval->nombre . ' ' . $benefval->apellido }}</td>
				<td style="text-align: center">{{ $benefval->numero_afiliado }}</td>
				<td style="text-align: center">{{ $benefval->codigo_seguridad }}</td>
				<td style="text-align: center">{{ $codigo_prestacion }}</td>
				<td style="text-align: center">{{ $benefval->cantidad_solicitada }}</td>
				<td>{{ substr($benefval->notas,0,10).'...' }}</td>
				<td style="text-align: center;">
					<input {{Auth::user()->mes != date('m') || Auth::user()->anio != date('Y') ? 'disabled' : ''}} type="text" name="traditum" id="traditum" beneficiario-id="{{$benefval->id}}" traditum-id="{{ $data['traditums'][$benefval->id][0]['id'] }}" value="{{ $data['traditums'][$benefval->id][0]['codigo']}}" style="border: none; text-align: center; background: transparent;">
				</td>
				<td style="width: 200px">
					<div class="btn-group">		
						<a target="_BLANK" href="{{ route('formulario-beneficiario', ['id' => $benefval->id, 'prestador_id' => $prestador_id ,'planilla' => $planilla, 'mes' => Auth::user()->mes, 'anio' => Auth::user()->anio]) }}" class="btn btn-primary" style="color: white; background-color: #605CA8"><i class="fa fa-address-card"></i></a>
						
						<button class="btn btn-primary btnHorarioBeneficiario" data-toggle="modal" data-target="#modalHorarioBeneficiario" idBenef="{{ $benefval->id }}" cuenta-tope="{{ $data['fechas']['tope'][$benefval->id][$benefval->id] }}" cuenta-original="{{ count($data['fechas']['total'][$benefval->id])}}" cuenta-agregados="{{ $data['fechas']['total_agregado'][$benefval->id] }}"><i class="fa fa-clock-o"></i></button>

						<button class="btn btn-warning btnEditarBeneficiario" data-toggle="modal" data-target="#modalEditarBeneficiario" style="{{Auth::user()->mes != date('m') || Auth::user()->anio != date('Y') ? 'display:none' : ''}}" idBenef="{{ $benefval->id }}"><i class="fa fa-pencil"></i></button>

						<button class="btn btn-danger btnEliminarBeneficiario" idOs="{{ $os_id }}" idBenef="{{ $benefval->id }}"><i class="fa fa-trash"></i></button>

						<button type="button" class="btn {{ $benefval->activo == 1 ? 'btn-success' : 'btn-secondary' }}"><input type="checkbox" class="btnEstadoBeneficiario" name="btnActivarUsuario" {{ $benefval->activo == 1 ? 'checked' : '' }} value="{{ $benefval->activo }}" idBenef="{{ $benefval->id }}" idOs={{ $os_id }} style="margin-top: 1px"></button>
					</div>
				</td>
            </tr>

            @endforeach

          @endforeach

          </tbody>

         </table>


       @else

        <table class="table table-bordered table-striped tablaBeneficiario">

          <thead>

           <tr>

             <th style="text-align: center">Clonar</th>
              @if($data['obrasocial'][0]->nombre == "OSECAC")
                <th style="width: 20px">Presupuesto</th>
              @endif

             <th>Nombre</th>
             <th>Apellido</th>
             <th>Prestacion</th>
             <th>Email</th>
             <th>Teléfono</th>
             <th>Direccion</th>
             <th>Localidad</th>
             <th>DNI</th>
             <th>CUIT</th>
             <th>Acciones</th>

           </tr>

          </thead>

          <tbody>

          @foreach($data['beneficiarios'] as $beneficiario)

            <?php $prestacionprof = $beneficiario->prestacion[0]->nombre ?>

            @foreach($beneficiario->beneficiario as $key => $benefval)

            <tr>

              <td style="text-align: center"> <button class="btn btn-success btnClonarBeneficiario" data-toggle="modal" data-target="#modalClonarBeneficiario" idBenef="{{ $benefval->id }}"><i class="fa fa-users"></i></button></td>
              @if($data['obrasocial'][0]->nombre == "OSECAC")
                <td style="text-align: center"><a href="{{ route('beneficiario-presupuesto', ['prestador_id' => $benefval->prestador_id, 'beneficiario_id' => $benefval->id]) }}" target="_BLANK"><button class="btn btn-success">8.4</button></a></td>
              @endif

              <td>{{ $benefval->nombre }}</td>
              <td>{{ $benefval->apellido }}</td>
              <td>{{ $prestacionprof }}</td>
              <td>{{ $benefval->email }}</td>
              <td>{{ $benefval->telefono }}</td>
              <td>{{ $benefval->direccion }}</td>
              <td>{{ $benefval->localidad }}</td>
              <td>{{ $benefval->dni }}</td>
              <td>{{ $benefval->cuit }}</td>
              <td>
                <div class="btn-group">

                    <button class="btn btn-primary btnClonarBeneficiario" data-toggle="modal" data-target="#modalClonarBeneficiario" idBenef="{{ $benefval->id }}"><i class="fa fa-clock-o"></i></button>

                    <button class="btn btn-warning btnEditarBeneficiario" data-toggle="modal" data-target="#modalEditarBeneficiario" idBenef="{{ $benefval->id }}"><i class="fa fa-pencil"></i></button>

                  <button class="btn btn-danger"><i class="fa fa-trash"></i></button>

                </div>

              </td>

            </tr>

            <?php $i++ ?>

            @endforeach

          @endforeach

          </tbody>

         </table>

       @endif

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR BENEFICIARIO
======================================-->

<div id="modalAgregarBeneficiario" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="POST" action="{{ route('beneficiario-create') }}">
        @csrf

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar beneficiario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- Entrada para Obra Social-->
            <div class="form-group col-lg-12">

              <div class="input-group col-lg-12">

                <div class="col-lg-12">

                    <label for="obraSocial">Obra Social</label>

                    <select type="text" class="form-control input-lg" name="obraSocial" readonly>

                      @foreach($data['obrasocial'] as $key=>$os)

                          <option value="{{ $os->id }}">{{ $os->nombre }}</option>

                      @endforeach

                    </select>

                </div>

              </div>

            </div>

              <!-- ENTRADA PARA NOMBRE Y APELLIDO -->

              <div class="form-group col-lg-12">

                  <div class="input-group col-lg-12">

                      <div class="col-lg-12">

                          <label for="nombre">Nombre y Apellido</label>

                          <input type="text" class="form-control input-lg" name="nombre" placeholder="Ingresar nombre y Apellido">

                      </div>


                  </div>

              </div>

              <div class="form-group col-lg-12">

                  <div class="input-group col-lg-12">

                      <div class="col-lg-6">

                          <label for="numero_afiliado">Numero de Beneficiario</label>

                          <input type="text" class="form-control input-lg" name="numero_afiliado" placeholder="Ingresar N° de Beneficiario">

                      </div>

                      <div class="col-lg-6">

                          <label for="codigo_seguridad">Código de Seguridad</label>

                          <input type="text" class="form-control input-lg" name="codigo_seguridad" placeholder="Ingresar Código de Seguridad">

                      </div>

                  </div>

              </div>


            <!-- Entrada para Prestación -->
            <div class="form-group col-lg-12">

              <div class="input-group col-lg-12">

                <div class="col-lg-6">

                    <label for="obraSocial">Prestación</label>

                    <select type="text" class="form-control input-lg" name="prestacion" required>

                      <option value="">Seleccionar...</option>

                      @foreach ($data['prestacion'] as $presta)
                        <option value="{{ $presta->id }}">{{ $presta->prestacion[0]->codigo_modulo . ' - ' . $presta->prestacion[0]->nombre }}</option>
                      @endforeach

                    </select>

                </div>

                    <div class="col-lg-6">

                        <label for="cantidad_solicitada">Cantidad Solicitada</label>

                        <input type="text" class="form-control input-lg" name="cantidad_solicitada">                    
                    </div>

              </div>

            </div>

              <!--Entrada para DNI y CUIT -->

              <div class="form-group col-lg-12">

                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="dni">DNI</label>

                        <input type="text" class="form-control input-lg" name="dni" placeholder="Ingresar DNI">

                  </div>

                  <div class="col-lg-6">

                        <label for="cuit">CUIT</label>

                        <input type="text" class="form-control input-lg" name="cuit" placeholder="Ingresar CUIT">

                  </div>

                </div>

              </div>


              <!--Entrada para correo y telefono -->

                <div class="form-group col-lg-12">

                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="telefono">Telefono</label>

                        <input type="text" class="form-control input-lg" name="telefono" placeholder="Ingresar Telefono">

                  </div>

                  <div class="col-lg-6">

                        <label for="correo">Correo</label>

                        <input type="email" class="form-control input-lg" name="correo" placeholder="Ingresar correo">

                  </div>

                </div>

              </div>

              <!--Entrada para direccion y localidad -->

              <div class="form-group col-lg-12">

                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="direccion">Dirección del Beneficiario</label>

                        <input type="text" class="form-control input-lg" name="direccion" placeholder="Ingresar Dirección">

                  </div>

                  <div class="col-lg-6">

                        <label for="localidad">Localidad del Beneficiario</label>

                        <input type="text" class="form-control input-lg" name="localidad" placeholder="Ingresar Localidad">

                  </div>

                </div>

              </div>

               <!--Entrada para Dir. Prestacion y Localidad Prestacion -->

              <div class="form-group col-lg-12">

                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="codigoPostal">Dirección de Prestación</label>

                        <input type="text" class="form-control input-lg" name="direccionPrestacion" placeholder="Ingresar Dirección de Prestación">

                  </div>

                  <div class="col-lg-6">

                        <label for="codigoPostal">Localidad de Prestación</label>

                        <input type="text" class="form-control input-lg" name="localidadPrestacion" placeholder="Ingresar Localidad de Prestación">

                  </div>


                </div>

              </div>


              @if(Auth::user()->role == 'Traslado')

              <!--Entrada para KM ida y vuelta -->

              <div class="form-group col-lg-12">

                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="kmIda">KM de ida</label>

                        <input type="number" class="form-control input-lg" name="kmIda" placeholder="Ingresar KM de ida">

                  </div>

                  <div class="col-lg-6">

                        <label for="kmVuelta">KM de vuelta</label>

                        <input type="text" class="form-control input-lg" name="kmVuelta" placeholder="Ingresar KM de Vuelta">

                  </div>

                </div>

              </div>

              <!--Entrada para Viajes de ida y vuelta -->

              <div class="form-group col-lg-12">

                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="viajesIda">Viajes de ida</label>

                        <input type="text" class="form-control input-lg" name="viajesIda" placeholder="Ingresar Viajes de ida">

                  </div>

                  <div class="col-lg-6">

                        <label for="viajesVuelta">Viajes de vuelta</label>

                        <input type="number" class="form-control input-lg" name="viajesVuelta" placeholder="Ingresar Viajes de vuelta">

                  </div>

                </div>

              </div>

              @endif

              <!-- Entrada para Turno y Dependencia -->

              <div class="form-group col-lg-12">

                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="turno">Turno</label>

                        <select type="text" class="form-control input-lg" name="turno">
                              <option value="Mañana">Mañana</option>
                              <option value="Tarde">Tarde</option>
                              <option value="Noche">Noche</option>
                        </select>

                  </div>

                </div>

              </div>



                @if(Auth::user()->role == 'Traslado')

                <div class="form-group col-lg-12">

                    <div class="input-group col-lg-12">

                          <div class="col-lg-6">

                                <label for="dependencia">Dependencia</label>

                                <select type="text" class="form-control input-lg" name="dependencia" placeholder="Ingresar Dependencia">
                                    <option>Seleccionar...</option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>

                          </div>

                    </div>

                </div>

                @endif

              <!-- Entrada para notas -->
               <div class="form-group col-lg-12">

                <div class="input-group col-lg-12">

                    <textarea type="text" name="notas" maxlength="255" rows="5" cols="130" placeholder="Notas..">

                    </textarea>

                </div>

              </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar beneficiario</button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR BENEFICIARIO
======================================-->

<div id="modalEditarBeneficiario" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="POST" action="{{ route('beneficiario-update') }}">
        @csrf

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar beneficiario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- Entrada para Obra Social-->
            <div class="form-group col-lg-12">

              <div class="input-group col-lg-12">

                <div class="col-lg-12">

                    <label for="editarObraSocial">Obra Social</label>

                    <select type="text" class="form-control input-lg" id="editarObraSocial" name="editarObraSocial" readonly>

                      @foreach($data['obrasocial'] as $key=>$os)

                          <option value="{{ $os->id }}">{{ $os->nombre }}</option>

                      @endforeach

                    </select>

                </div>

              </div>

            </div>

           <!-- ENTRADA PARA NOMBRE Y APELLIDO -->

            <div class="form-group col-lg-12">

                <div class="input-group col-lg-12">

                  <div class="col-lg-12">

                        <label for="editarNombre">Editar Nombre y Apellido</label>

                        <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" placeholder="Ingresar nombre">

                  </div>

                </div>

              </div>

              <!-- Entrada para Num. Beneficiario y Cod. Seguridad -->

                <div class="form-group col-lg-12">

                  <div class="input-group col-lg-12">

                    <div class="col-lg-6">

                        <label for="numero_afiliado">Numero de Beneficiario</label>

                        <input type="text" class="form-control input-lg" id="editar_numero_afiliado" name="editar_numero_afiliado">

                    </div>                    

                      <div class="col-lg-6">

                          <label for="codigo_seguridad">Codigo de Seguridad</label>

                          <input type="text" class="form-control input-lg" id="editar_codigo_seguridad" name="editar_codigo_seguridad">

                      </div>

                  </div>

              </div>

              <!-- Entrada para cant. prestacion solicitada -->

               <div class="form-group col-lg-12">

                  <div class="input-group col-lg-12">

                        <div class="col-lg-6">

                          <label for="cantidad_solicitada">Cantidad de Prestacion Solicitada</label>

                          <input type="text" class="form-control input-lg" id="editar_cantidad_solicitada" name="editar_cantidad_solicitada">

                      </div>

					  <div class="col-lg-6">

                        <label for="editarDni">Editar DNI</label>

                        <input type="text" class="form-control input-lg" id="editarDni" name="editarDni" placeholder="Ingresar DNI">

					  </div>   

                  </div>

              </div>

              <!--Entrada para CUIT y DNI -->

              <div class="form-group col-lg-12">

                <div class="input-group col-lg-12">       

                  <div class="col-lg-6">

                        <label for="editarCuit">Editar CUIT</label>

                        <input type="text" class="form-control input-lg" id="editarCuit" name="editarCuit" placeholder="Ingresar CUIT">

				  </div>
				  
				  <div class="col-lg-6">

					<label for="editarTelefono">Editar Telefono</label>

					<input type="text" class="form-control input-lg" id="editarTelefono" name="editarTelefono" placeholder="Ingresar Telefono">

			  		</div>  

                </div>

              </div>


              <!--Entrada para correo y telefono -->

                <div class="form-group col-lg-12">

                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="editarCorreo">Editar Correo</label>

                        <input type="email" class="form-control input-lg" id="editarCorreo" name="editarCorreo" placeholder="Ingresar correo">

				  </div>
				  
                  <div class="col-lg-6">

					<label for="editarDireccion">Editar Dirección del Beneficiario</label>

					<input type="text" class="form-control input-lg" id="editarDireccion" name="editarDireccion" placeholder="Ingresar Dirección">

			  		</div>

                </div>

              </div>

              <!--Entrada para direccion y localidad -->

              <div class="form-group col-lg-12">

                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="editarLocalidad">Editar Localidad del Beneficiario</label>

                        <input type="text" class="form-control input-lg" id="editarLocalidad" name="editarLocalidad" placeholder="Ingresar Localidad">

				  </div>
				  
				  <div class="col-lg-6">

					<label for="editarDireccionPrestacion">Editar Dirección de Prestación</label>

					<input type="text" class="form-control input-lg" id="editarDireccionPrestacion" name="editarDireccionPrestacion" placeholder="Ingresar Dirección de Prestación">

					</div>

                </div>

              </div>

               <!--Entrada para Codigo Postal y DNI -->

              <div class="form-group col-lg-12">

                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="editarLocalidadPrestacion">Editar Localidad de Prestación</label>

                        <input type="text" class="form-control input-lg" id="editarLocalidadPrestacion" name="editarLocalidadPrestacion" placeholder="Ingresar Localidad de Prestación">

                  </div>


				  <div class="col-lg-6">

					<label for="editarTurno">Turno</label>

					<select type="text" class="form-control input-lg" id="editarTurno" name="editarTurno">
						  <option value="Mañana">Mañana</option>
						  <option value="Tarde">Tarde</option>
						  <option value="Noche">Noche</option>
					</select>

			  		</div>

                </div>

              </div>



              <!--Entrada para KM ida y vuelta -->

              @if(Auth::user()->role == 'Traslado')

                  <div class="form-group col-lg-12">

                    <div class="input-group col-lg-12">

                      <div class="col-lg-6">

                            <label for="editarKmIda">Editar KM de ida</label>

                            <input type="text" class="form-control input-lg" id="editarKmIda" name="editarKmIda" placeholder="Ingresar KM de ida">

                      </div>

                      <div class="col-lg-6">

                            <label for="editarKmVuelta">Editar KM de vuelta</label>

                            <input type="text" class="form-control input-lg" id="editarKmVuelta" name="editarKmVuelta" placeholder="Ingresar KM de Vuelta">

                      </div>

                    </div>

                  </div>

                  <!--Entrada para Viajes de ida y vuelta -->

                  <div class="form-group col-lg-12">

                    <div class="input-group col-lg-12">

                      <div class="col-lg-6">

                            <label for="editarViajesIda">Editar Viajes de ida</label>

                            <input type="text" class="form-control input-lg" id="editarViajesIda" name="editarViajesIda" placeholder="Ingresar Viajes de ida">

                      </div>

                      <div class="col-lg-6">

                            <label for="editarViajesVuelta">Editar Viajes de vuelta</label>

                            <input type="text" class="form-control input-lg" id="editarViajesVuelta" name="editarViajesVuelta" placeholder="Ingresar Viajes de vuelta">

                      </div>

                    </div>

                  </div>

              @endif


              @if(Auth::user()->role == 'Traslado')

                  <div class="form-group col-lg-12">

                      <div class="input-group col-lg-12">

                      <div class="col-lg-6">

                            <label for="editarDependencia">Dependencia</label>

                            <select type="text" class="form-control input-lg" id="editarDependencia" name="editarDependencia" placeholder="Ingresar Dependencia">
                                <option>Seleccionar...</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>

                      </div>

                    </div>

                  </div>

              @endif

              <!-- Entrada para notas -->
               <div class="form-group col-lg-12">

                <div class="input-group col-lg-12">

                    <textarea type="text" id="editarNotas" name="editarNotas" maxlength="255" rows="5" cols="130" placeholder="Notas..">

                    </textarea>

                </div>

              </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar beneficiario</button>

        </div>

        <input type="hidden" name="id" id="id">

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL HORARIO BENEFICIARIO
======================================-->

<div id="modalHorarioBeneficiario" class="modal fade" role="dialog">

    <input type="hidden" class="obra_social" name="obra_social" value="{{$data['obrasocial'][0]->nombre}}">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

{{--             <form role="form" method="POST" action="{{ route('sesion-create') }}">

            @csrf --}}

            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title horarioBeneficiario"></h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

					<div class="alert alert-danger text-center horarioFail" style="display: none;">
						<span id="horarioFail"></span>
					</div>
	
					<div class="alert alert-success text-center horarioSuccess" style="display: none;">
						<span id="horarioSuccess"></span>
					</div>

                      <div class="alert alert-danger text-center alertBenef" style="display:none">
                          <span id="errorBenef"></span>
                      </div>

                      <div class="row">
                        <div class="form-group col-lg-12">
                            <div class="input-group col-lg-12">
                                <div class="col-lg-3" style="margin-left: 15px;">
                                  <label for="tope">Tope Dias mensuales</label>
                                  <input type="text" class="form-control topeBenef" name="tope" id="tope" idBenef placeholder="Sin tope">
                                </div>
                                <div class="col-lg-3">
								  <label for="btnTope">Activar Tope</label><br>
								  <div class="btn-group">
									  {{-- <div class="input-group"><button type="button" class="btn btn-success btnTope" id="btnTope"><i class="fa fa-check"></i></button></div> --}}
										<div class="radio" style="margin-top: 0px; margin-bottom: 2px;">
											<label>
												<input type="radio" class="topeRadio" name="optionRadios" id="optionsRadios1" value="sinTope">
												Sin activar
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" class="topeRadio" name="optionRadios" id="optionsRadios2" value="conTope">
												Tope activado
											</label>
										</div>
								  </div>
                                </div>

								<div class="col-lg-12">
									<div class="col-lg-9" style="margin-top: 25px;">
										<button type="button" class="btn btn-primary btnHorarioIndividual">Agregar Horario</button>
										<form class="formHorarios">
											<div class="horarioIndividual" style="display: none;">
												<div class="col-lg-4" style="padding-left: 0; margin-top: 15px;">
													<label for="fechas[]">Fecha</label>
												<input type="number" id="fechas[]" class="form-control fechasMask" name="fechas[]" value="{{ date('d') }}" placeholder="Dia" min="1" max="31">
												</div>
	
												<div class="col-lg-2" style="margin-top: 45px;">
													{{-- <button class="btn btn-xs btn-success btnAgregarHorario" type="button"><i class="fa fa-plus"></i></button> --}}
													<button class="btn btn-xs btn-success btnAgregarHorario" type="button"><i class="fa fa-plus"></i></button>
													<input type="hidden" name="id_beneficiario" class="id_beneficiario" value>
													<input type="hidden" name="cantidad" value="individual">
												</div>
												<div id="inputsAdicionales"></div>                
											</div>
										  </form>
									</div>

									

									<div class="col-lg-3 text-right" style="margin-top: 25px;">
										<button type="button" class="btn btn-primary btnInasistencias" data-toggle="modal" data-target="#modalInasistenciasBeneficiario" idBenef>Inasistencias</button>
									</div>
								</div>
                            </div>
                        </div>
                      </div>
                      

                        <!-- Entrada para Obra Social-->
                        <div class="form-group col-lg-12">

                            <div class="input-group col-lg-12">

									<div class="col-lg-12">
										<label for="dia">Dias</label>
										<select multiple type="text" class="form-control input-lg" id="dia" name="dia[]" required>
											<option value="1">Lunes</option>
											<option value="2">Martes</option>
											<option value="3">Miercoles</option>
											<option value="4">Jueves</option>
											<option value="5">Viernes</option>
											<option value="6">Sabado</option>
											<option value="7">Domingo</option>
										</select>
									</div>

                               

                                <div class="col-lg-4">

                                    <label for="dia">Hora</label>

                                    <input type="text" class="form-control input-lg" id="hora" name="hora" placeholder="HH:MM (24hs)" data-inputmask="'alias': 'hh:mm'" data-mask required>

                                </div>

                                <div class="col-lg-4">

                                    <label for="tiempo">Duracion en minutos</label>

                                    <select type="number" class="form-control input-lg" id="tiempo" name="tiempo" required>
                                        <option value="">Seleccionar..</option>
                                        <option value="45">45</option>
                                        <option value="60">60</option>
                                        <option value="90">90</option>
                                        <option value="120">120</option>
                                        <option value="135">135</option>
                                        <option value="180">180</option>
                                        <option value="210">210</option>
										<option value="240">240</option>
										<option value="300">300</option>
                                    </select>

                                </div>

                                <div class="col-lg-4">

                                    <label for="guardar">Guardar horario</label>

                                    <button type="button" id="guardarHorario" idBeneficiario class="btn btn-success form-control input-lg"><i class="fa fa-check"></i></button>

                                </div>

                            </div>

                        </div>

                        <hr>

                        <div class="form-group col-lg-12" style="margin-left: 20px">
                            <div class="input-group col-lg-12">
                                <table style="width: 100%">
                                    <thead>
                                        <th>Dia</th>
                                        <th>Hora</th>
                                        <th>Duracion</th>
                                        <th>Acciones</th>
                                    </thead>

                                    <tbody id="horarioBenef">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>

                <input type="hidden" name="beneficiario_id" id="beneficiario_id">
                <input type="hidden" name="obrasocial_id" id="obrasocial_id" value={{ $data['obrasocial'][0]->id }}>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



                </div>

{{--  </form> --}}

        </div>

    </div>

</div>


<!--=====================================
MODAL INASISTENCIAS BENEFICIARIO
======================================-->

<div id="modalInasistenciasBeneficiario" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

      <div class="modal-content">

{{--             <form role="form" method="POST" action="{{ route('sesion-create') }}">

          @csrf --}}

          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->

              <div class="modal-header" style="background:#3c8dbc; color:white">

                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                  <h4 class="modal-title inasistenciaBeneficiario"></h4>

              </div>

              <!--=====================================
              CUERPO DEL MODAL
              ======================================-->

              <div class="modal-body" style="margin-bottom: 40px;">
                <div class="box-body">
                  <div class="alert alert-danger text-center inasistenciaFail" style="display: none;">
                    <span id="inasistenciaFail"></span>
                  </div>

                  <div class="alert alert-success text-center inasistenciaSuccess" style="display: none;">
                    <span id="inasistenciaSuccess"></span>
                  </div>

                  <div class="col-lg-12">        
                    <div class="row">
                      <div class="col-lg-12">
                        <button type="button" class="btn btn-primary btnInasistenciaIndividual">Agregar Inasistencia individual</button>
                        {{-- <button type="button" class="btn btn-primary btnRangoHorario">Agregar rango de horario</button> --}}
                        <button type="button" class="btn btn-primary btnRangoInasistencia">Agregar rango de Inasistencia</button>
                      </div>
                    </div>
                    <form class="formInasistencias">
                      <div class="col-lg-6 inasistenciaIndividual" style="margin-top: 20px; margin-bottom: 20px; display:none;">
                          <div class="row">
                            <div class="col-lg-4">
                              <label for="fechas[]">Fecha</label>
							<input type="number" id="fechas[]" class="form-control input-sm fechasMask" name="fechas[]" placeholder="Dia" min="1" max="31" value="{{ date('d') }}">
                            </div>
                            <div class="col-lg-2" style="padding-left: 0px; margin-top: 30px;">
                              {{-- <button class="btn btn-xs btn-success btnAgregarHorario" type="button"><i class="fa fa-plus"></i></button> --}}
                              <button class="btn btn-xs btn-danger btnRemoverHorario" type="button"><i class="fa fa-plus"></i></button>
                              <input type="hidden" name="id_beneficiario" class="id_beneficiario" value>
							  <input type="hidden" name="cantidad" value="individual">
                            </div>
                          </div>
                        	<div id="inputsAdicionales"></div>                
					  </div>
					</form>
                      <form class="formRangoHorario">
                      <div class="col-lg-6 rangoHorario" style="margin-top: 20px; margin-bottom: 20px; display:none;">
                        <div class="row">
                          <button type="button" class="btn btn-default pull-left" id="daterange-btn"> 
                            <span>            
                              <i class="fa fa-calendar"> Rango de Fecha </i>
                              <i class="fa fa-caret-down"></i>
                            </span>
                          </button>
                        </div>
                      </div>
                        <input type="hidden" name="id_beneficiario" class="id_beneficiario" value>
                        <input type="hidden" name="cantidad" class="cantidad" value="rango">
                      </form>

                      <form class="formRangoInasistencia">
                        <div class="col-lg-6 rangoInasistencia" style="margin-top: 20px; margin-bottom: 20px; display:none;">
                          <div class="row">
                            <button type="button" class="btn btn-default pull-left" id="daterange-btn"> 
                              <span>            
                                <i class="fa fa-calendar"> Rango de Fecha </i>
                                <i class="fa fa-caret-down"></i>
                              </span>
                            </button>
                          </div>
                        </div>
                          <input type="hidden" name="id_beneficiario" class="id_beneficiario" value>
                          <input type="hidden" name="cantidad" class="cantidad" value="rango">
                        </form>

                    <div class="col-lg-12" style="padding-left: 0;">
                      <div class="row" style="padding-left: 0;">
                        <div class="col-lg-12" style="padding-left: 0;">
                          <div class="row">
                            <div class="col-lg-12" style="margin-left: 15px;">
                              <div class="col-lg-3">
                                <strong>Fechas</strong>
                              </div>
                              <div class="col-lg-3">
                                <strong>Tipo</strong>
                              </div>
                              
                            </div>
                          </div>
                          <div class="appended-inasistencias">

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!--=====================================
              PIE DEL MODAL
              ======================================-->

              <div class="modal-footer">

                  <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

                  {{-- <button type="button" class="btn btn-primary btnGuardarInasistencias">Guardar Inasistencias</button> --}}

              </div>

{{--  </form> --}}

      </div>

  </div>

</div>

<!--=====================================
MODAL CLONAR BENEFICIARIO
======================================-->

<div id="modalClonarBeneficiario" class="modal fade" role="dialog">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form role="form" method="POST" action="{{ route('beneficiario-create') }}">
            @csrf

            <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar beneficiario</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- Entrada para Obra Social-->
                        <div class="form-group col-lg-12">

                            <div class="input-group col-lg-12">

                                <div class="col-lg-12">

                                    <label for="obraSocial">Obra Social</label>

                                    <select type="text" class="form-control input-lg" name="obraSocial" readonly>

                                        @foreach($data['obrasocial'] as $key=>$os)

                                            <option value="{{ $os->id }}">{{ $os->nombre }}</option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>

                        </div>

                        <!-- ENTRADA PARA NOMBRE Y APELLIDO -->

                        <div class="form-group col-lg-12">

                            <div class="input-group col-lg-12">

                                <div class="col-lg-12">

                                    <label for="nombre">Nombre</label>

                                    <input type="text" class="form-control input-lg" id="nombre_clon" name="nombre" placeholder="Ingresar nombre">

                                </div>


                            </div>

                        </div>

                        <div class="form-group col-lg-12">

                            <div class="input-group col-lg-12">

                                <div class="col-lg-6">

                                    <label for="numero_afiliado">Numero de Beneficiario</label>

                                    <input type="text" class="form-control input-lg" id="numero_afiliado_clon" name="numero_afiliado" placeholder="Ingresar N° de Beneficiario">

                                </div>

                                <div class="col-lg-6">

                                    <label for="codigo_seguridad">Código de Seguridad</label>

                                    <input type="text" class="form-control input-lg" id="codigo_seguridad_clon" name="codigo_seguridad" placeholder="Ingresar Código de Seguridad">

                                </div>

                            </div>

                        </div>


                        <!-- Entrada para Prestación -->
                        <div class="form-group col-lg-12">

                            <div class="input-group col-lg-12">

                                <div class="col-lg-5">

                                    <label for="obraSocial">Prestación</label>

                                    <select type="text" class="form-control input-lg" id="prestacion_clon" name="prestacion">

                                        <option value="">Seleccionar...</option>

                                        @foreach ($data['prestacion'] as $presta)
                                            <option value="{{ $presta->id }}">{{ $presta->prestacion[0]->codigo_modulo . ' - ' . $presta->prestacion[0]->nombre }}</option>
                                        @endforeach

                                    </select>

                                </div>

                                <div class="col-lg-3">

                                  <label for="codigo_seguridad">Codigo Traditum</label>

                                  <input type="text" class="form-control input-lg" id="codigo_traditum" name="codigo_traditum">

                                </div>

                                <div class="col-lg-4">

                                    <label for="cantidad_solicitada">Cantidad Solicitada</label>

                                    <input type="text" class="form-control input-lg" id="cantidad_solicitada_clon" name="cantidad_solicitada">

                                </div>

                            </div>

                        </div>


                        <!--Entrada para correo y telefono -->

                        <div class="form-group col-lg-12">

                            <div class="input-group col-lg-12">

                                <div class="col-lg-6">

                                    <label for="correo">Correo</label>

                                    <input type="email" class="form-control input-lg" id="correo_clon" name="correo" placeholder="Ingresar correo">

                                </div>

                                <div class="col-lg-6">

                                    <label for="telefono">Telefono</label>

                                    <input type="text" class="form-control input-lg" id="telefono_clon" name="telefono" placeholder="Ingresar Telefono">

                                </div>

                            </div>

                        </div>

                        <!--Entrada para direccion y localidad -->

                        <div class="form-group col-lg-12">

                            <div class="input-group col-lg-12">

                                <div class="col-lg-6">

                                    <label for="direccion">Dirección del Beneficiario</label>

                                    <input type="text" class="form-control input-lg" id="direccion_clon" name="direccion" placeholder="Ingresar Dirección">

                                </div>

                                <div class="col-lg-6">

                                    <label for="localidad">Localidad del Beneficiario</label>

                                    <input type="text" class="form-control input-lg" id="localidad_clon" name="localidad" placeholder="Ingresar Localidad">

                                </div>

                            </div>

                        </div>

                        <!--Entrada para Codigo Postal y DNI -->

                        <div class="form-group col-lg-12">

                            <div class="input-group col-lg-12">

                                <div class="col-lg-6">

                                    <label for="codigoPostal">Dirección de Prestación</label>

                                    <input type="text" class="form-control input-lg" id="direccionPrestacion_clon" name="direccionPrestacion" placeholder="Ingresar Dirección de Prestación">

                                </div>

                                <div class="col-lg-6">

                                    <label for="codigoPostal">Localidad de Prestación</label>

                                    <input type="text" class="form-control input-lg" id="localidadPrestacion_clon" name="localidadPrestacion" placeholder="Ingresar Localidad de Prestación">

                                </div>


                            </div>

                        </div>

                        <!--Entrada para CUIT y Prestacion -->

                        <div class="form-group col-lg-12">

                            <div class="input-group col-lg-12">

                                <div class="col-lg-6">

                                    <label for="cuit">CUIT</label>

                                    <input type="text" class="form-control input-lg" id="cuit_clon" name="cuit" placeholder="Ingresar CUIT">

                                </div>

                                <div class="col-lg-6">

                                    <label for="dni">DNI</label>

                                    <input type="text" class="form-control input-lg" id="dni_clon" name="dni" placeholder="Ingresar DNI">

                                </div>

                            </div>

                        </div>

                    @if(Auth::user()->role == 'Traslado')

                        <!--Entrada para KM ida y vuelta -->

                            <div class="form-group col-lg-12">

                                <div class="input-group col-lg-12">

                                    <div class="col-lg-6">

                                        <label for="kmIda">KM de ida</label>

                                        <input type="number" class="form-control input-lg" id="kmIda_clon" name="kmIda" placeholder="Ingresar KM de ida">

                                    </div>

                                    <div class="col-lg-6">

                                        <label for="kmVuelta">KM de vuelta</label>

                                        <input type="text" class="form-control input-lg" id="kmVuelta_clon" name="kmVuelta" placeholder="Ingresar KM de Vuelta">

                                    </div>

                                </div>

                            </div>

                            <!--Entrada para Viajes de ida y vuelta -->

                            <div class="form-group col-lg-12">

                                <div class="input-group col-lg-12">

                                    <div class="col-lg-6">

                                        <label for="viajesIda">Viajes de ida</label>

                                        <input type="text" class="form-control input-lg" id="viajesIda_clon" name="viajesIda" placeholder="Ingresar Viajes de ida">

                                    </div>

                                    <div class="col-lg-6">

                                        <label for="viajesVuelta">Viajes de vuelta</label>

                                        <input type="number" class="form-control input-lg" id="viajesVuelta_clon" name="viajesVuelta" placeholder="Ingresar Viajes de vuelta">

                                    </div>

                                </div>

                            </div>

                    @endif

                    <!-- Entrada para Turno y Dependencia -->

                        <div class="form-group col-lg-12">

                            <div class="input-group col-lg-12">

                                <div class="col-lg-6">

                                    <label for="turno">Turno</label>

                                    <select type="text" class="form-control input-lg" id="turno_clon" name="turno">
                                        <option value="Mañana">Mañana</option>
                                        <option value="Tarde">Tarde</option>
                                        <option value="Noche">Noche</option>
                                    </select>

                                </div>

                            </div>

                        </div>



                        @if(Auth::user()->role == 'Traslado')

                            <div class="form-group col-lg-12">

                                <div class="input-group col-lg-12">

                                    <div class="col-lg-6">

                                        <label for="dependencia">Dependencia</label>

                                        <select type="text" class="form-control input-lg" id="dependencia_clon" name="dependencia" placeholder="Ingresar Dependencia">
                                            <option>Seleccionar...</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>

                                    </div>

                                </div>

                            </div>

                    @endif

                        <!-- Entrada para notas -->
                        <div class="form-group col-lg-12">

                            <div class="input-group col-lg-12">

                                <textarea type="text" name="notas" maxlength="255" rows="5" cols="130" id="notas_clon" placeholder="Notas..">

                                </textarea>

                            </div>

                        </div>

                    </div>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar beneficiario</button>

                </div>

            </form>

        </div>

    </div>

</div>


@endsection
