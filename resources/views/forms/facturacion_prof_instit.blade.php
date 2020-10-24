<!DOCTYPE html>
<head>
<html lang="es">
<meta charset="utf-8">
<title>Plantilla</title>
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}" media="all">
<link rel="stylesheet" href="{{ asset('css/estilosi.css') }}" media="print" />
</head>
<body>
	<div id="contenedor"><div id="boton_im"><input type="button" name="imprimir" value="IMPRIMIR" onclick="window.print();"></div>
		<header id="principal">
		<span id="titulo">PLANILLA FACTURACION SISTEMA ATENCION INTEGRAL DISCAPACITADOS (SAID) Res 105-134/05
			<br />DETALLE FACTURACION DE MODULOS</span>
		</header>
		<div id="contenido">
			<form method="post">
				<div id="datos">
					<div id="d_nombre">
						<label for="d_nombre">NOMBRE PROFESIONAL ó INSTITUCION: </label>
						<input type="text" name="d_nombre" class="input_dnombre" value="{{Auth::user()->name . ' ' . Auth::user()->surname}}"></div>
					<div class='salto'></div>
					<div id="d_periodo">
						<label for="periodo1">PERIODO:</label>
						<input type="text" name="periodo1" class="d_periodo1" maxlength="10">
					<div class='salto'></div>
				</div>

				<div id="titulos"><span class="tit_afiliado">Número de Afiliado</span> 
					<span class="tit_nombre">Nombre y Apellido del afiliado</span> 
					<span class="tit_cantidad">Cant.</span>
					<span class="tit_modulo">Código Módulo</span> 
					<span class="tit_svi">Código Validación - SVI</span> 
					<span class="tit_importe">Importe</span> 
					<span class="tit_firma">Firma afiliado o Tutor</span> 
				</div>
				<div id="columnas">
					@php
						$indice = 0;
					@endphp
					@foreach($beneficiarios as $beneficiario)
						<div class='linea arriba'>
							<div class='nro_afiliado'><input type='text' name='nro_afiliado_0' maxlength='12' value="{{$beneficiario->numero_afiliado}}"></div>
							<div class='nombre'><input type='text' name='nombre_0' value="{{$beneficiario->nombre}}"></div>
							<div class="cantidad"><input type="text" name='cantidad_0' value="{{$beneficiario->cantidad_solicitada}}"></div>
							<div class='modulo'><input type='text' name='modulo_0' value="{{$beneficiario->codigo_modulo}}"></div>
							<div class='svi'><input type='text' name='svi_0' value="{{isset($beneficiario->traditum->codigo) ? $beneficiario->traditum->codigo : ''}}"></div>
							<div class='importe'><input type='text' name='importe_0'></div>
							<div class='firma'><input type='text' name='firma_0'></div>
							<div class='salto'></div>
						</div>
						@php
							$indice++
						@endphp
					@endforeach

					@for ($i = $indice; $i < 17; $i++)
						<div class='linea arriba'>
							<div class='nro_afiliado'><input type='text' name='nro_afiliado_0' maxlength='12'></div>
							<div class='nombre'><input type='text' name='nombre_0'></div>
							<div class="cantidad"><input type="text" name='cantidad_0'></div>
							<div class='modulo'><input type='text' name='modulo_0'></div>
							<div class='svi'><input type='text' name='svi_0'></div>
							<div class='importe'><input type='text' name='importe_0'></div>
							<div class='firma'><input type='text' name='firma_0'></div>
							<div class='salto'></div>
						</div>
					@endfor
{{-- <div class='linea'><div class='nro_afiliado'><input type='text' name='nro_afiliado_1' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_1'></div>
<div class='modulo'><input type='text' name='modulo_1'></div>
<div class='svi'><input type='text' name='svi_1'></div>
<div class='importe'><input type='text' name='importe_1'></div>
<div class='firma'><input type='text' name='firma_1'></div>
<div class='salto'></div>
</div>
<div class='linea'><div class='nro_afiliado'><input type='text' name='nro_afiliado_2' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_2'></div>
<div class='modulo'><input type='text' name='modulo_2'></div>
<div class='svi'><input type='text' name='svi_2'></div>
<div class='importe'><input type='text' name='importe_2'></div>
<div class='firma'><input type='text' name='firma_2'></div>
<div class='salto'></div>
</div>
<div class='linea'><div class='nro_afiliado'><input type='text' name='nro_afiliado_3' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_3'></div>
<div class='modulo'><input type='text' name='modulo_3'></div>
<div class='svi'><input type='text' name='svi_3'></div>
<div class='importe'><input type='text' name='importe_3'></div>
<div class='firma'><input type='text' name='firma_3'></div>
<div class='salto'></div>
</div>
<div class='linea'><div class='nro_afiliado'><input type='text' name='nro_afiliado_4' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_4'></div>
<div class='modulo'><input type='text' name='modulo_4'></div>
<div class='svi'><input type='text' name='svi_4'></div>
<div class='importe'><input type='text' name='importe_4'></div>
<div class='firma'><input type='text' name='firma_4'></div>
<div class='salto'></div>
</div>
<div class='linea'><div class='nro_afiliado'><input type='text' name='nro_afiliado_5' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_5'></div>
<div class='modulo'><input type='text' name='modulo_5'></div>
<div class='svi'><input type='text' name='svi_5'></div>
<div class='importe'><input type='text' name='importe_5'></div>
<div class='firma'><input type='text' name='firma_5'></div>
<div class='salto'></div>
</div>
<div class='linea'><div class='nro_afiliado'><input type='text' name='nro_afiliado_6' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_6'></div>
<div class='modulo'><input type='text' name='modulo_6'></div>
<div class='svi'><input type='text' name='svi_6'></div>
<div class='importe'><input type='text' name='importe_6'></div>
<div class='firma'><input type='text' name='firma_6'></div>
<div class='salto'></div>
</div>
<div class='linea'><div class='nro_afiliado'><input type='text' name='nro_afiliado_7' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_7'></div>
<div class='modulo'><input type='text' name='modulo_7'></div>
<div class='svi'><input type='text' name='svi_7'></div>
<div class='importe'><input type='text' name='importe_7'></div>
<div class='firma'><input type='text' name='firma_7'></div>
<div class='salto'></div>
</div>
<div class='linea'><div class='nro_afiliado'><input type='text' name='nro_afiliado_8' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_8'></div>
<div class='modulo'><input type='text' name='modulo_8'></div>
<div class='svi'><input type='text' name='svi_8'></div>
<div class='importe'><input type='text' name='importe_8'></div>
<div class='firma'><input type='text' name='firma_8'></div>
<div class='salto'></div>
</div>
<div class='linea'><div class='nro_afiliado'><input type='text' name='nro_afiliado_9' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_9'></div>
<div class='modulo'><input type='text' name='modulo_9'></div>
<div class='svi'><input type='text' name='svi_9'></div>
<div class='importe'><input type='text' name='importe_9'></div>
<div class='firma'><input type='text' name='firma_9'></div>
<div class='salto'></div>
</div>
<div class='linea'><div class='nro_afiliado'><input type='text' name='nro_afiliado_10' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_10'></div>
<div class='modulo'><input type='text' name='modulo_10'></div>
<div class='svi'><input type='text' name='svi_10'></div>
<div class='importe'><input type='text' name='importe_10'></div>
<div class='firma'><input type='text' name='firma_10'></div>
<div class='salto'></div>
</div>
<div class='linea'><div class='nro_afiliado'><input type='text' name='nro_afiliado_11' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_11'></div>
<div class='modulo'><input type='text' name='modulo_11'></div>
<div class='svi'><input type='text' name='svi_11'></div>
<div class='importe'><input type='text' name='importe_11'></div>
<div class='firma'><input type='text' name='firma_11'></div>
<div class='salto'></div>
</div>
<div class='linea'><div class='nro_afiliado'><input type='text' name='nro_afiliado_12' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_12'></div>
<div class='modulo'><input type='text' name='modulo_12'></div>
<div class='svi'><input type='text' name='svi_12'></div>
<div class='importe'><input type='text' name='importe_12'></div>
<div class='firma'><input type='text' name='firma_12'></div>
<div class='salto'></div>
</div>
<div class='linea'><div class='nro_afiliado'><input type='text' name='nro_afiliado_13' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_13'></div>
<div class='modulo'><input type='text' name='modulo_13'></div>
<div class='svi'><input type='text' name='svi_13'></div>
<div class='importe'><input type='text' name='importe_13'></div>
<div class='firma'><input type='text' name='firma_13'></div>
<div class='salto'></div>
</div>
<div class='linea'><div class='nro_afiliado'><input type='text' name='nro_afiliado_14' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_14'></div>
<div class='modulo'><input type='text' name='modulo_14'></div>
<div class='svi'><input type='text' name='svi_14'></div>
<div class='importe'><input type='text' name='importe_14'></div>
<div class='firma'><input type='text' name='firma_14'></div>
<div class='salto'></div>
</div>
<div class='linea'><div class='nro_afiliado'><input type='text' name='nro_afiliado_15' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_15'></div>
<div class='modulo'><input type='text' name='modulo_15'></div>
<div class='svi'><input type='text' name='svi_15'></div>
<div class='importe'><input type='text' name='importe_15'></div>
<div class='firma'><input type='text' name='firma_15'></div>
<div class='salto'></div>
</div> --}}
{{-- <div class='linea abajo'><div class='nro_afiliado'><input type='text' name='nro_afiliado_16' maxlength='12'></div>
<div class='nombre'><input type='text' name='nombre_16'></div>
<div class='modulo'><input type='text' name='modulo_16'></div>
<div class='svi'><input type='text' name='svi_16'></div>
<div class='importe'><input type='text' name='importe_16'></div>
<div class='firma'><input type='text' name='firma_16'></div>
<div class='salto'></div> --}}
</div>
				</div>
				<div id="importe_total"><label for="importe_total">IMPORTE TOTAL </label><input type="text" name="importe_total" value=""></div>
				<div id="firma">Firma y Sello del Profesional</div>
				
			</form>
		</div>
		<div id="footer">
					CENTRO DE ATENCIÓN AL AFILIADO 0 800 888 2776 - E-mail: comunicaciones.apross@cba.gov.ar
				</div>
	</div>
	
</body>
</html>