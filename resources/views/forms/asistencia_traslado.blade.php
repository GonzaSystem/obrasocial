<!DOCTYPE html>
<!-- saved from url=(0049)http://localhost/adrian/asistencia/asistencia.php -->
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	

<meta name="author" content="Ulises Ayllapan, ulises4@gmail.com">
	<title>Planilla asistencia</title>
<link rel="stylesheet" href="{{asset('css/estilosi_traslado_asistencia.css')}}" media="print">
<style type="text/css">
	body {
		text-align: center;
		background: #4e5255;
	}
	input{border: none; background: none}
	#cabecera {
		position: absolute;
		margin-top: 73px;
		text-align: left;
		margin-left: 700px;
	}
	#cabecera * {
		position: relative;
	}
	#contenedor {
		width:1132px;
		height:802x;
		margin:auto;
	}
	#transporte {
		display: block;
		width:450px;

	}
	#transporte1 {width: 100px; float: left}
	#periodo {
		margin-top: 10px;
	}
	#codigo { margin-left: 200px;
		width:80px;
	}
	.clear {
		clear: both;
	}
	#datos { position: absolute;
		margin-top: 150px;
		margin-left: 58px;
		width:1095px;
		text-align: left;
	}
	.fila {
		width:1195px;
	}

	textarea { height:60px;	resize: none; border: 1px solid #fff}
	
.f0 textarea{height:66px;}
.f1 textarea{height:55px;}
.f2 textarea{height:66px;}
.f3 textarea{height:69px;}
.f4 textarea{height:70px;}
.f5 textarea{height:70px;}
.f6 textarea{height:68px;}
	.c0{width: 128px;}
	.c1{width: 131px;}
	.c2{width: 221px;}
	.c3{width: 183px;}
	.c4{width: 59px;margin-left: 1px;}
	.c5{width: 250px}

	#firma {margin-left:762px;margin-top: 18px}
	#firma input {text-align: center}
	#firma1{width: 255px; }
	#boton_im {
	position:absolute;
	margin-top:70px;
	margin-left: 510px;
}
#boton_im input{
	width: 90px;
	height: 25px;
	color:#fff;
	background: #000;
	border:none;
	border-radius: 15px;
}
</style></head>


<body>
<div id="contenedor"><div id="boton_im"><input type="button" name="imprimir" value="IMPRIMIR" onclick="window.print();"></div>
<div id="cabecera">
	<div id="transporte"><input type="text" name="transporte" id="transporte1" value="{{Auth::user()->mes}}">
		<input type="text" name="codigo" id="codigo" value="{{Auth::user()->anio}}">
	</div>
	<div class="clear"></div>
</div>
<div id="datos">
			@php
				$indice = 0;
			@endphp
			@foreach ($beneficiarios as $k => $benef)
				<div class="fila f{{$k}}">
					<textarea wrap="" name="text0" class="c0">{{$benef->nombre}}</textarea>
					<textarea wrap="" name="text1" class="c1">{{$benef->numero_afiliado}}</textarea>
					<textarea wrap="" name="text2" class="c2">{{$benef->direccion}}</textarea>
					<textarea wrap="" name="text3" class="c3">{{$benef->direccion_prestacion}}</textarea>
					<textarea wrap="" name="text4" class="c4">{{$benef->total_fechas}}</textarea>
					<textarea wrap="" name="text5" class="c5"></textarea>
				</div>
				@php
					$indice++;
				@endphp
			@endforeach

			@for ($i = $indice; $i < 7; $i++)
				<div class="fila f{{$i}}">
					<textarea wrap="" name="text0" class="c0"></textarea>
					<textarea wrap="" name="text1" class="c1"></textarea>
					<textarea wrap="" name="text2" class="c2"></textarea>
					<textarea wrap="" name="text3" class="c3"></textarea>
					<textarea wrap="" name="text4" class="c4"></textarea>
					<textarea wrap="" name="text5" class="c5"></textarea>
				</div>
			@endfor
		<div id="importe">
		<div id="firma"><input type="text" name="firma" id="firma1">
	</div>
</div>

</div>

<img src="{{asset('img/imagen.jpg')}}" width="1131" height="800">
</div>

</body></html>