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
		}
	});
});