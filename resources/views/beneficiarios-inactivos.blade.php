@extends('layouts.app', ['prestador' => $prestador_menu])

@section('content')
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Módulo de Beneficiarios Inactivos

    </h1>

     <div style="padding-top: 15px">
        @include('includes.message')
     </div>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Video Tutoriales</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas">

        <thead>

         <tr>
		   <th>Apellido y Nombre</th>
		   <th>Prestacion</th>
		   <th>Obra Social</th>
           <th>Acctiones</th>
         </tr>

        </thead>
        <tbody>

			@foreach ($beneficiarios as $beneficiario)
				@php
					$os_id = $beneficiario->os_id;
					$prestacion = $beneficiario->prestacion[0]->nombre;
					$os = $beneficiario->obrasocial[0]->nombre;
				@endphp
				@foreach($beneficiario->beneficiarioInactivo as $benef)
					<tr>
						<td>{{ $benef->nombre }}</td>
						<td>{{ $prestacion }}</td>
						<td>{{ $os }}</td>
						<td>
							<div class="btn-group">
								<button class="btn btn-danger btnEliminarBeneficiarioInactivo" idOs="{{ $os_id }}" idBenef="{{ $benef->id }}"><i class="fa fa-trash"></i></button>
								<button type="button" class="btn btn-warning"><input type="checkbox" class="btnEstadoBeneficiarioInactivo" name="btnActivarUsuario" {{ $benef->activo == 1 ? 'checked' : '' }} value="{{ $benef->activo }}" idBenef="{{ $benef->id }}" idOs={{ $os_id }} style="margin-top: 1px"></button>
							</div>
						</td>
					</tr>			
				@endforeach
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

<div id="modalAgregarVideo" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" action="{{ route('video-create') }}">

        @csrf

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Video</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA DESCRIPCION -->

            <div class="form-group">

              <label for="obra_social">Descripcion</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" id="description" class="form-control input-lg" name="description" placeholder="Ingresar Descripcion" required>

              </div>

            </div>

          <!-- ENTRADA PARA URL VIDEO -->

            <div class="form-group">

              <label for="codigo_modulo">URL del Video</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-play"></i></span>

                <input type="text" id="url_video" class="form-control input-lg" name="url_video" placeholder="Ingresar URL del Video. Ej: https://www.youtube.com/watch?v=NuPbsD48sns">

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Video</button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR VIDEO
======================================-->

<div id="modalEditarVideo" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" action="{{ route('video-update') }}">

        <input type="hidden" name="id" id="video_id">

        @csrf

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Video</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA DESCRIPCION -->

            <div class="form-group">

              <label for="obra_social">Editar Descripcion</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" id="video_description" class="form-control input-lg" name="description" placeholder="Ingresar Descripcion" required>

              </div>

            </div>

          <!-- ENTRADA PARA URL VIDEO -->

            <div class="form-group">

              <label for="codigo_modulo">Editar URL del Video</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-play"></i></span>

                <input type="text" id="video_url_video" class="form-control input-lg" name="url_video" placeholder="Ingresar URL del Video. Ej: https://www.youtube.com/watch?v=NuPbsD48sns">

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Video</button>

        </div>

      </form>

    </div>

  </div>

</div>

@endsection
