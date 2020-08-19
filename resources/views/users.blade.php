@extends('layouts.app', ['prestador' => $prestador_menu])

@section('content')
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Módulo de Usuarios.

    </h1>

     <div style="padding-top: 15px">
        @include('includes.message')
     </div>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Usuarios</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas">

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Usuario</th>
           <th>Rol</th>
           <th>Acciones</th>

         </tr>

        </thead>

        <tbody>

          @foreach ($users as $key => $user)

          <tr>
            <td>{{ ($key+1) }}</td>
            <td>{{ $user->name . " " . $user->surname }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->email }}</td>

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

@endsection
