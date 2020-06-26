@extends('layouts.app', ['prestador' => $prestador_menu])

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
          Módulo de beneficiarios - {{ $obrasocial[0]->nombre }} <br> 
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

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarBeneficiario">
          
          Agregar Beneficiario

        </button>

      </div>

      <div class="box-body">

      @if($obrasocial[0]->nombre == "APROSS")
        
         <table class="table table-bordered table-striped dt-responsive tablas">
           
          <thead>
           
           <tr>
             
             <th style="width:10px">#</th>

              @if($obrasocial[0]->nombre == "OSECAC")
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


          @foreach($beneficiarios as $beneficiario)

            <?php $prestacionprof = $beneficiario->prestacion ?>

            @foreach($beneficiario->beneficiario as $key => $benefval)

            <tr>

              <td>{{ $key+1 }}</td>

              @if($obrasocial[0]->nombre == "OSECAC")
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
                    
                  <button class="btn btn-warning btnEditarBeneficiario" data-toggle="modal" data-target="#modalEditarBeneficiario" idBenef="{{ $benefval->id }}"><i class="fa fa-pencil"></i></button>

                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                </div>  

              </td>

            </tr>

            @endforeach

          @endforeach

          </tbody>

         </table>


       @else

                 <table class="table table-bordered table-striped dt-responsive tablas">
           
          <thead>
           
           <tr>
             
             <th style="width:10px">#</th>

              @if($obrasocial[0]->nombre == "OSECAC")
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


          @foreach($beneficiarios as $beneficiario)

            <?php $prestacionprof = $beneficiario->prestacion[0]->nombre ?>

            @foreach($beneficiario->beneficiario as $key => $benefval)

            <tr>

              <td>{{ $key+1 }}</td>

              @if($obrasocial[0]->nombre == "OSECAC")
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
                    
                  <button class="btn btn-warning btnEditarBeneficiario" data-toggle="modal" data-target="#modalEditarBeneficiario" idBenef="{{ $benefval->id }}"><i class="fa fa-pencil"></i></button>

                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                </div>  

              </td>

            </tr>

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

                      @foreach($obrasocial as $key=>$os)

                          <option value="{{ $os->id }}">{{ $os->nombre }}</option>
                          
                      @endforeach

                    </select>

                </div>  

              </div>

            </div>

            <!-- Entrada para Prestación -->
            <div class="form-group col-lg-12">
              
              <div class="input-group col-lg-12">
                
                <div class="col-lg-12">
                  
                    <label for="obraSocial">Prestación</label>

                    <select type="text" class="form-control input-lg" name="prestacion">

                      <option value="">Seleccionar...</option>

                      @foreach ($prestacion as $presta)
                        <option value="{{ $presta->id }}">{{ $presta->prestacion[0]->nombre }}</option>
                      @endforeach

                    </select>

                </div>  

              </div>

            </div>

           <!-- ENTRADA PARA NOMBRE Y APELLIDO -->

                <div class="form-group col-lg-12">
                
                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="nombre">Nombre</label>

                        <input type="text" class="form-control input-lg" name="nombre" placeholder="Ingresar nombre">

                  </div>
                
                  <div class="col-lg-6">

                        <label for="apellido">Apellido</label>

                        <input type="text" class="form-control input-lg" name="apellido" placeholder="Ingresar apellido">

                  </div>

                </div>

              </div>            


              <!--Entrada para correo y telefono -->

                <div class="form-group col-lg-12">
                
                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="correo">Correo</label>

                        <input type="email" class="form-control input-lg" name="correo" placeholder="Ingresar correo">

                  </div>
                
                  <div class="col-lg-6">

                        <label for="telefono">Telefono</label>

                        <input type="text" class="form-control input-lg" name="telefono" placeholder="Ingresar Telefono">

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

               <!--Entrada para Codigo Postal y DNI -->

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

              <!--Entrada para CUIT y Prestacion -->

              <div class="form-group col-lg-12">
                
                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="cuit">CUIT</label>

                        <input type="text" class="form-control input-lg" name="cuit" placeholder="Ingresar CUIT">

                  </div>

                  <div class="col-lg-6">

                        <label for="dni">DNI</label>

                        <input type="text" class="form-control input-lg" name="dni" placeholder="Ingresar DNI">

                  </div>         

                </div>

              </div>

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

                      @foreach($obrasocial as $key=>$os)

                          <option value="{{ $os->id }}">{{ $os->nombre }}</option>
                          
                      @endforeach

                    </select>

                </div>  

              </div>

            </div>

           <!-- ENTRADA PARA NOMBRE Y APELLIDO -->

                <div class="form-group col-lg-12">
                
                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="editarNombre">Editar Nombre</label>

                        <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" placeholder="Ingresar nombre">

                  </div>
                
                  <div class="col-lg-6">

                        <label for="editarApellido">Editar Apellido</label>

                        <input type="text" class="form-control input-lg" id="editarApellido" name="editarApellido" placeholder="Ingresar apellido">

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

                        <label for="editarTelefono">Editar Telefono</label>

                        <input type="text" class="form-control input-lg" id="editarTelefono" name="editarTelefono" placeholder="Ingresar Telefono">

                  </div>

                </div>

              </div>

              <!--Entrada para direccion y localidad -->

              <div class="form-group col-lg-12">
                
                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="editarDireccion">Editar Dirección del Beneficiario</label>

                        <input type="text" class="form-control input-lg" id="editarDireccion" name="editarDireccion" placeholder="Ingresar Dirección">
                          
                  </div>
                
                  <div class="col-lg-6">

                        <label for="editarLocalidad">Editar Localidad del Beneficiario</label>

                        <input type="text" class="form-control input-lg" id="editarLocalidad" name="editarLocalidad" placeholder="Ingresar Localidad">

                  </div>

                </div>

              </div>

               <!--Entrada para Codigo Postal y DNI -->

              <div class="form-group col-lg-12">
                
                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="editarDireccionPrestacion">Editar Dirección de Prestación</label>

                        <input type="text" class="form-control input-lg" id="editarDireccionPrestacion" name="editarDireccionPrestacion" placeholder="Ingresar Dirección de Prestación">

                  </div>

                  <div class="col-lg-6">

                        <label for="editarLocalidadPrestacion">Editar Localidad de Prestación</label>

                        <input type="text" class="form-control input-lg" id="editarLocalidadPrestacion" name="editarLocalidadPrestacion" placeholder="Ingresar Localidad de Prestación">

                  </div>
                

                </div>

              </div>

              <!--Entrada para CUIT y Prestacion -->

              <div class="form-group col-lg-12">
                
                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="editarCuit">Editar CUIT</label>

                        <input type="text" class="form-control input-lg" id="editarCuit" name="editarCuit" placeholder="Ingresar CUIT">

                  </div>

                  <div class="col-lg-6">

                        <label for="editarDni">Editar DNI</label>

                        <input type="text" class="form-control input-lg" id="editarDni" name="editarDni" placeholder="Ingresar DNI">

                  </div>         

                </div>

              </div>

              <!--Entrada para KM ida y vuelta -->

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

              <!-- Entrada para Turno y Dependencia -->

              <div class="form-group col-lg-12">
                
                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="editarTurno">Turno</label>

                        <select type="text" class="form-control input-lg" id="editarTurno" name="editarTurno">
                              <option value="Mañana">Mañana</option>
                              <option value="Tarde">Tarde</option>
                              <option value="Noche">Noche</option>
                        </select>

                  </div>
                
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

@endsection
