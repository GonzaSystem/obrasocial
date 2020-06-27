$('.sidebar-toggle').on('click',function(){

           var cls =  $('body').hasClass('sidebar-collapse');
           if(cls == true){
                $('body').removeClass('sidebar-collapse');
           } else {
                $('body').addClass('sidebar-collapse');
           }

    });


// Info de OS
$(document).on('click', '.btnEditarOs', function(){
	var id = $(this).attr("idos");

$.ajaxSetup({
	headers: {
	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});


$.ajax({
	url: "http://localhost/os/public/obrasocial/list",
	data: {id:id},
	dataType: "json",
	type: "POST",
	success: function(respuesta){
		$("#id").val(respuesta["id"]);
		$("#editarNombre").val(respuesta["nombre"]);
		$("#editarTipoObra").val(respuesta["tipo_obra"]);
		$("#editarCuit").val(respuesta["cuit"]);
		$("#editarTelefono").val(respuesta["telefono"]);
		$("#editarCiudad").val(respuesta["ciudad"]);
		$("#editarDireccion").val(respuesta["direccion"]);
		$("#editarEmail").val(respuesta["email"]);
		$("#editarCondicionIva").val(respuesta["condicion_iva"]);
		$("#editarValorSesion").val(respuesta["valor_sesion"]);
		$("#editarValorKm").val(respuesta["valor_km"]);
		$("#editarValorModulo").val(respuesta["valor_modulo"]);
		}
	});
});

// Editar Prestacion
$(document).on('click', '.btnEditarPrestacion', function(){

var id = $(this).attr("idprest");

$.ajaxSetup({
	headers: {
	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$.ajax({
	url: "http://localhost/os/public/prestador/list",
	data: {id:id},
	dataType: "json",
	type: "POST",
	success: function(respuesta){
		$("#editarNumeroPrestador").val(respuesta["numero_prestador"]);
		$("#id").val(respuesta["id"]);
		}
	});
});

//Editar Beneficiario
$(document).on('click', '.btnEditarBeneficiario', function(){

var id = $(this).attr("idbenef");

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$.ajax({
	url: "http://localhost/os/public/beneficiario/list",
	data: {id:id},
	dataType: "json",
	type: "POST",
	success: function(respuesta){
		console.log("respuesta", respuesta);
		$("#id").val(respuesta[0]["id"]);
		$("#editarNombre").val(respuesta[0]["nombre"]);
		$("#editarApellido").val(respuesta[0]["apellido"]);
		$("#editarCorreo").val(respuesta[0]["email"]);
		$("#editarTelefono").val(respuesta[0]["telefono"]);
		$("#editarDireccion").val(respuesta[0]["direccion"]);
		$("#editarLocalidad").val(respuesta[0]["localidad"]);
		$("#editarDireccionPrestacion").val(respuesta[0]["direccion_prestacion"]);
		$("#editarLocalidadPrestacion").val(respuesta[0]["localidad_prestacion"]);
		$("#editarCuit").val(respuesta[0]["cuit"]);
		$("#editarDni").val(respuesta[0]["dni"]);
		$("#editarKmIda").val(respuesta[0]["km_ida"]);
		$("#editarKmVuelta").val(respuesta[0]["km_vuelta"]);
		$("#editarViajesIda").val(respuesta[0]["viajes_ida"]);
		$("#editarViajesVuelta").val(respuesta[0]["viajes_vuelta"]);
		$("#editarTurno").val(respuesta[0]["turno"]);
		$("#editarDependencia").val(respuesta[0]["dependencia"]);
		$("#editarNotas").val(respuesta[0]["notas"]);
		}
	});
});

// Traigo prestaciones segun OS
$(document).on('change', '#obraSocial', function(){
	var idOs = $("#obraSocial").val();
	$("#role_profesion").empty();
	$("#role_profesion").append('<option value="">Seleccionar...</option>');
	
	$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
		});

		$.ajax({
			url: "http://localhost/os/public/prestacion/show/"+idOs+"",
			// data: {id:id},
			dataType: "json",
			success: function(respuesta){
				console.log("respuesta", respuesta);
				$.each(respuesta, function(key, val){
					$("#role_profesion").append('<option value='+val.id+'>'+val.nombre+'</option>');
				});
			}
		});
	});

// Agrego campo de valor personalizado
$(document).on('change', '#utiliza_valor_profesion', function(){
	if($("#utiliza_valor_profesion").val() == 'F'){
		$("#valor_profesion_personalizado").empty();
		$("#valor_profesion_personalizado").append('<label for="valor_profesion">Valor de Profesion</label><input type="text" name="valor_profesion" class="form-control" placeholder="Valor de profesion">');
	}else{
		$("#valor_profesion_personalizado").empty();
	}
});

// Agrego campo de valor personalizado en edicion
$(document).on('change', '#editar_utiliza_valor_profesion', function(){
	if($("#editar_utiliza_valor_profesion").val() == 'F'){
		$("#editar_valor_profesion_personalizado").empty();
		$("#editar_valor_profesion_personalizado").append('<label for="valor_profesion">Valor de Profesion</label><input type="text" name="valor_profesion" class="form-control" placeholder="Valor de profesion">');
	}else{
		$("#editar_valor_profesion_personalizado").empty();
	}
});

// Editar prestacion
$(document).on('click', '#btnEditarPrestacion', function(){
	var idPrest = $("#btnEditarPrestacion").val();
	console.log("idPrest", idPrest);

	$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
	});

		$.ajax({
			url: "http://localhost/os/public/prestacionind/show/"+idPrest+"",
			// data: {id:id},
			dataType: "json",
			success: function(respuesta){
				$("#editar_obra_social").val(respuesta[0]['os_id']);
				$("#editar_codigo_modulo").val(respuesta[0]['codigo_modulo']);
				$("#editar_prestacion").val(respuesta[0]['nombre']);
				$("#editar_valor_prestacion").val(respuesta[0]['valor_modulo']);
				$("#id").val(respuesta[0]['id']);
			}
		});
	});
