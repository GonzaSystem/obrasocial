// Data tables
$(document).ready(function(){

   $.noConflict();
    var table = $('.tablaBeneficiario').DataTable({
      "deferRender": true,
      "retrieve": true,
      "order": [1, 'asc'],
      "pageLength": 50,
      "processing": true,
         "language": {

          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_ registros",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "Buscar:",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }

      }
   });

    $("#searchbox").keyup(function() {
        table.search(this.value).draw();
    }); 
})
 

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

// Editar datos Prestador
$(document).on('click', '.btnEditarPrestacion', function(){F

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
        $("#editar_utiliza_valor_profesion").val(respuesta["valor_default"]);
		$("#id").val(respuesta["id"]);
        $("#editar_mover_dias").val(respuesta["mover_dias"]);
        $("#editar_quitar_feriado").val(respuesta["quitar_feriado"]);
        $("#editar_tope").val(respuesta["tope"]);
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
		$("#id").val(respuesta['beneficiario'][0]["id"]);
		$("#editarNombre").val(respuesta['beneficiario'][0]["nombre"]);
		$("#editarApellido").val(respuesta['beneficiario'][0]["apellido"]);
		$("#editarCorreo").val(respuesta['beneficiario'][0]["email"]);
		$("#editarTelefono").val(respuesta['beneficiario'][0]["telefono"]);
		$("#editarDireccion").val(respuesta['beneficiario'][0]["direccion"]);
		$("#editarLocalidad").val(respuesta['beneficiario'][0]["localidad"]);
		$("#editarDireccionPrestacion").val(respuesta['beneficiario'][0]["direccion_prestacion"]);
		$("#editarLocalidadPrestacion").val(respuesta['beneficiario'][0]["localidad_prestacion"]);
		$("#editarCuit").val(respuesta['beneficiario'][0]["cuit"]);
		$("#editarDni").val(respuesta['beneficiario'][0]["dni"]);
		$("#editarKmIda").val(respuesta['beneficiario'][0]["km_ida"]);
		$("#editarKmVuelta").val(respuesta['beneficiario'][0]["km_vuelta"]);
		$("#editarViajesIda").val(respuesta['beneficiario'][0]["viajes_ida"]);
		$("#editarViajesVuelta").val(respuesta['beneficiario'][0]["viajes_vuelta"]);
		$("#editarTurno").val(respuesta['beneficiario'][0]["turno"]);
		$("#editarDependencia").val(respuesta['beneficiario'][0]["dependencia"]);
		$("#editarNotas").val(respuesta['beneficiario'][0]["notas"]);
		$("#editar_numero_afiliado").val(respuesta['beneficiario'][0]['numero_afiliado']);
		$("#editar_codigo_seguridad").val(respuesta['beneficiario'][0]['codigo_seguridad']);
		$("#editar_cantidad_solicitada").val(respuesta['beneficiario'][0]['cantidad_solicitada']);
    $("#codigo_traditum").val(respuesta['traditum'][0]['codigo']);
		}
	});
});

// Eliminar beneficiario
$(document).on("click", ".btnEliminarBeneficiario", function(){

  var idBenef = $(this).attr("idBenef");
  var idOs = $(this).attr("idOs");

  swal({
    title: '¿Está seguro de borrar el beneficiario?',
    text: "¡Una vez eliminado, la acción no se podrá deshacer!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar beneficiario!'
  }).then(function(result){

    if(result.value){

      window.location = "http://localhost/os/public/beneficiario/delete/"+idOs+"/"+idBenef+"";

    }

  });

});

// Activar o desactivar beneficiario
$(document).on('change', '.btnEstadoBeneficiario', function(){
  var idBenef = $(this).attr('idBenef');
  var idOs = $(this).attr('idOs');

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  if(this.checked){
    var status = 1;
    window.location = "http://localhost/os/public/beneficiario/status/"+idBenef+"/"+idOs+'/'+status
    
  }else{
    var status = 0;
    window.location = "http://localhost/os/public/beneficiario/status/"+idBenef+"/"+idOs+'/'+status
  }

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
	var idPrest = $(this).attr("idPrest");

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
				$("#editar_planilla").val(respuesta[0]['planilla']);
				$("#id").val(respuesta[0]['id']);
			}
		});
	});

// Eliminar prestacion
$(document).on("click", "#btnEliminarPrestacion", function(){

  var idPrest = $(this).attr("idPrest");

  swal({
    title: '¿Está seguro de borrar la prestación?',
    text: "¡Una vez eliminada, la acción no se podrá deshacer!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar prestación!'
  }).then(function(result){

    if(result.value){

      window.location = "http://localhost/os/public/prestacion/delete/"+idPrest;

    }

  })

})

/*Data mask*/
$(document).ready(function($){
    //Datemask hh:mm
    $('#datemask').inputmask('hh:mm', { 'placeholder': 'hh:mm am/pm' });
    //Datemask2 hh:mm
    $('#datemask2').inputmask('hh:mm', { 'placeholder': 'hh:mm am/pm' });
    //Money Euro
    $('[data-mask]').inputmask();
});

// Clonar beneficiario

$(document).on('click', '.btnClonarBeneficiario', function(){
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
        	$("#nombre_clon").empty();
            $("#correo_clon").empty();
            $("#telefono_clon").empty();
            $("#direccion_clon").empty();
            $("#localidad_clon").empty();
            $("#direccionPrestacion_clon").empty();
            $("#localidadPrestacion_clon").empty();
            $("#cuit_clon").empty();
            $("#dni_clon").empty();
            $("#kmIda_clon").empty();
            $("#kmVuelta_clon").empty();
            $("#viajesIda_clon").empty();
            $("#viajesVuelta_clon").empty();
            $("#dependencia_clon").empty();
            $("#notas_clon").empty();
            $("#numero_afiliado_clon").empty();
            $("#codigo_seguridad_clon").empty();
            $("#cantidad_solicitada_clon").empty();


            $("#nombre_clon").val(respuesta['beneficiario'][0]["nombre"]);
            $("#correo_clon").val(respuesta['beneficiario'][0]["email"]);
            $("#telefono_clon").val(respuesta['beneficiario'][0]["telefono"]);
            $("#direccion_clon").val(respuesta['beneficiario'][0]["direccion"]);
            $("#localidad_clon").val(respuesta['beneficiario'][0]["localidad"]);
            $("#prestacion_clon").val(respuesta['beneficiario'][0]["prestador"]["id"]);
            $("#direccionPrestacion_clon").val(respuesta['beneficiario'][0]["direccion_prestacion"]);
            $("#localidadPrestacion_clon").val(respuesta['beneficiario'][0]["localidad_prestacion"]);
            $("#cuit_clon").val(respuesta['beneficiario'][0]["cuit"]);
            $("#dni_clon").val(respuesta['beneficiario'][0]["dni"]);
            $("#KmIda_clon").val(respuesta['beneficiario'][0]["km_ida"]);
            $("#KmVuelta_clon").val(respuesta['beneficiario'][0]["km_vuelta"]);
            $("#ViajesIda_clon").val(respuesta['beneficiario'][0]["viajes_ida"]);
            $("#ViajesVuelta_clon").val(respuesta['beneficiario'][0]["viajes_vuelta"]);
            $("#turno_clon").val(respuesta['beneficiario'][0]["turno"]);
            $("#dependencia_clon").val(respuesta['beneficiario'][0]["dependencia"]);
            $("#notas_clon").val(respuesta['beneficiario'][0]["notas"]);
            $("#numero_afiliado_clon").val(respuesta['beneficiario'][0]['numero_afiliado']);
            $("#codigo_seguridad_clon").val(respuesta['beneficiario'][0]['codigo_seguridad']);
            $("#cantidad_solicitada_clon").val(respuesta['beneficiario'][0]['cantidad_solicitada']);

        }
    });
});



// Al presionar el boton de horarios traigo los resultados
$(document).on('click', '.btnHorarioBeneficiario', function(){
  $('.alertBenef').hide();
	var id = $(this).attr("idBenef");
	$("#horarioBenef").empty();
  $("#tope").empty();

	 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$("#beneficiario_id").val(id);

    $.ajax({
        url: "http://localhost/os/public/sesion/horarios",
        data: {id:id},
        dataType: "json",
        type: "POST",
        success: function(respuesta){
          
          $("#tope").val(respuesta['beneficiario']['tope']);
        	for (var i = 0; i < respuesta['sesiones'].length; i++) {
        		switch( respuesta['sesiones'][i]["dia"]){
        			case 1:
        				dia = 'Lunes';
        				break;
        			case 2:
        				dia = 'Martes';
        				break;
        			case 3: 
        				dia = 'Miercoles';
        				break;
        			case 4:
        				dia = 'Jueves';
        				break;
        			case 5:
        				dia = 'Viernes';
        				break;
        			case 6:
        				dia = 'Sabado';
        				break;
        			case 7:
        				dia = 'Domingo';
        				break;
        		}

        		$("#horarioBenef").append('<tr><td>'+dia+'</td><td>'+respuesta['sesiones'][i]["hora"]+'</td><td>'+respuesta['sesiones'][i]["tiempo"]+' minutos</td><td><button class="btn btn-danger btnEliminarSesion" idSesion="'+respuesta['sesiones'][i]["id"]+'"><i class="fa fa-trash"></i></button></td></tr>')
        	}
        }
    });

        var obrasocial = $('.obra_social').val(); 

        $.ajax({
        url: "http://localhost/os/public/beneficiario/list",
        data: {id:id},
        dataType: "json",
        type: "POST",
        success: function(respuesta){
                $('.horarioBeneficiario').empty();
                $('.horarioBeneficiario').append('Horario Beneficiario - '+respuesta['beneficiario'][0]['nombre']+ ' - '+respuesta['prestacion']+' - '+obrasocial);
            }
        });
    });

// Guardo Horario
$(document).on('click', '#guardarHorario', function(){
	
	// Obtengo valores
	var dia = $("#dia").val();
	var hora = $("#hora").val();
	var tiempo = $("#tiempo").val();
	var beneficiario_id = $("#beneficiario_id").val();
	var obrasocial_id = $("#obrasocial_id").val();
  var tope = $("#tope").val();

	$("#horarioBenef").empty();

    $.ajax({
        url: "http://localhost/os/public/sesion/create",
        data: {dia:dia, hora:hora, tiempo:tiempo, beneficiario_id:beneficiario_id, obrasocial_id:obrasocial_id, tope:tope},
        dataType: "json",
        type: "POST",
        success: function(respuesta){
            if(respuesta['error'] != false){
                $('#errorBenef').html(respuesta['error']);
                $('.alertBenef').show();
            }
        	for (var i = 0; i < respuesta['sesiones'].length; i++) {
        		switch( respuesta['sesiones'][i]["dia"]){
        			case 1:
        				dia = 'Lunes';
        				break;
        			case 2:
        				dia = 'Martes';
        				break;
        			case 3: 
        				dia = 'Miercoles';
        				break;
        			case 4:
        				dia = 'Jueves';
        				break;
        			case 5:
        				dia = 'Viernes';
        				break;
        			case 6:
        				dia = 'Sabado';
        				break;
        			case 7:
        				dia = 'Domingo';
        				break;
        		}

                $("#horarioBenef").append('<tr><td>'+dia+'</td><td>'+respuesta['sesiones'][i]["hora"]+'</td><td>'+respuesta['sesiones'][i]["tiempo"]+' minutos</td><td><button class="btn btn-danger btnEliminarSesion" idSesion="'+respuesta['sesiones'][i]["id"]+'"><i class="fa fa-trash"></i></button></td></tr>');  
        		$("#dia").val('');
        		$("#hora").val('');
        		$("#tiempo").val('');
        	}
        }
    });
});

//Eliminar sesion
$(document).on('click', '.btnEliminarSesion', function(){
	var id = $(this).attr("idSesion");
	var beneficiario_id = $("#beneficiario_id").val();

	$("#horarioBenef").empty();

	    $.ajax({
        url: "http://localhost/os/public/sesion/destroy",
        data: {id:id, beneficiario_id:beneficiario_id},
        dataType: "json",
        type: "POST",
        success: function(respuesta){
        	console.log("respuesta", respuesta);
        	for (var i = 0; i < respuesta.length; i++) {
        		switch( respuesta[i]["dia"]){
        			case 1:
        				dia = 'Lunes';
        				break;
        			case 2:
        				dia = 'Martes';
        				break;
        			case 3: 
        				dia = 'Miercoles';
        				break;
        			case 4:
        				dia = 'Jueves';
        				break;
        			case 5:
        				dia = 'Viernes';
        				break;
        			case 6:
        				dia = 'Sabado';
        				break;
        			case 7:
        				dia = 'Domingo';
        				break;
        		}

        		$("#horarioBenef").append('<tr><td>'+dia+'</td><td>'+respuesta[i]["hora"]+'</td><td>'+respuesta[i]["tiempo"]+' minutos</td><td><button class="btn btn-danger btnEliminarSesion" idSesion="'+respuesta[i]["id"]+'"><i class="fa fa-trash"></i></button></td></tr>');
        	}
        },
        error: function(response){
        	console.log('response', response);
        }
    });
});

// Editar video
$(document).on('click', '.btnEditarVideo', function(){
    var id = $(this).attr('data-id');
    $('#video_id').empty();
    $('#video_description').empty();
    $('#video_url_video').empty();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
          url: "http://localhost/os/public/video/list",
          data: {id:id},
          dataType: "json",
          type: "POST",
          success: function(respuesta){
              $('#video_id').val(respuesta['id']);
              $('#video_description').val(respuesta['description']);
              $('#video_url_video').val(respuesta['url_video']);
          }
        });
});

// Eliminar video
$(document).on('click', '.btnEliminarVideo', function(){
    var id = $(this).attr('data-id');

      swal({
        title: '¿Está seguro de borrar el video?',
        text: "¡Una vez eliminado, la acción no se podrá deshacer!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar video!'
      }).then(function(result){

        if(result.value){

          window.location = "http://localhost/os/public/video/delete/"+id;

        }

      })

})

// Mes y año
$(document).on('change', '.selectMes', function(){
   var idOs = $(this).attr('idOs');
   var idPrest = $(this).attr('idPrest');
   var anio = $('.selectAnio').val();
   var mes = $(this).val();

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $.ajax({
    url: "http://localhost/os/public/user/month",
    data: {mes:mes, idOs:idOs, idPrest:idPrest, anio:anio},
    type: "POST",
    success: function(respuesta){
      if(respuesta == 1){
       window.location = "http://localhost/os/public/beneficiarios/"+idPrest+"/"+idOs+"/"+mes+"/"+anio;
      }
    },
    error: function(respuesta){
      console.log('error', respuesta);
    }
  });
});

$(document).on('change', '#traditum', function(){
    var benef_id = $(this).attr('beneficiario-id');
    var tradit_id = $(this).attr('traditum-id');
    var val = $(this).val();
    console.log("val", val);

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: "http://localhost/os/public/beneficiario/traditum",
      data: {beneficiario:benef_id, traditum: tradit_id, valor:val},
      type: "POST",
      success: function(respuesta){
        console.log("respuesta", respuesta);      
      }
    });
});