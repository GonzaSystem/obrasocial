@extends('layouts.app', ['prestador' => $prestador_menu])

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
       @foreach($prestador as $key => $prestacion)
          Módulo de beneficiarios. <br> 
          <h4>
            Prestador: {{ $prestacion->user['name'] . ' ' . $prestacion->user['surname'] . ' - ' . $prestacion->prestacion}}
          </h4>
       @endforeach
    
    </h1>

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
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Apellido</th>
           <th>Email</th>
           <th>Teléfono</th>
           <th>Direccion</th>
           <th>Localidad</th>
           <th>Codigo Postal</th>
           <th>DNI</th>
           <th>CUIT</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        @foreach($beneficiarios as $key=>$beneficiario)

          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $beneficiario->nombre }}</td>
            <td>{{ $beneficiario->apellido }}</td>
            <td>{{ $beneficiario->email }}</td>
            <td>{{ $beneficiario->telefono }}</td>
            <td>{{ $beneficiario->direccion }}</td>
            <td>{{ $beneficiario->localidad }}</td>
            <td>{{ $beneficiario->cp }}</td>
            <td>{{ $beneficiario->dni }}</td>
            <td>{{ $beneficiario->cuit }}</td>
            <td>
              <div class="btn-group">
                  
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

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
MODAL AGREGAR CLIENTE
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

                        <label for="direccion">Dirección</label>

                        <input type="text" class="form-control input-lg" name="direccion" placeholder="Ingresar Dirección">
                          
                  </div>
                
                  <div class="col-lg-6">

                        <label for="localidad">Localidad</label>

                        <input type="text" class="form-control input-lg" name="localidad" placeholder="Ingresar Localidad">

                  </div>

                </div>

              </div>

               <!--Entrada para Codigo Postal y DNI -->

              <div class="form-group col-lg-12">
                
                <div class="input-group col-lg-12">

                  <div class="col-lg-6">

                        <label for="codigoPostal">Codigo Postal</label>

                        <input type="text" class="form-control input-lg" name="codigoPostal" placeholder="Ingresar Codigo Postal">

                  </div>
                
                  <div class="col-lg-6">

                        <label for="dni">DNI</label>

                        <input type="text" class="form-control input-lg" name="dni" placeholder="Ingresar DNI">

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

                        <label for="prestacion">Prestacion</label>

                        <input type="text" class="form-control input-lg" name="prestacion" placeholder="Ingresar Prestacion">

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

                        <input type="text" class="form-control input-lg" name="dependencia" placeholder="Ingresar Dependencia">

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

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

        <input type="hidden" name="prestador_id" value="{{ $prestador[0]->id }}">

      </form>

    </div>

  </div>

</div>

@endsection
