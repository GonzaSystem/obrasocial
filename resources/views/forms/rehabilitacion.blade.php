<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>PLANILLA DE ASISTENCIA DIARIA - REHABILITACIÓN</title>
		<link rel="stylesheet" href="{{ asset('css/app_2.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/apross/rehabilitation.css') }}" />
	</head>
	<body>
		<header>
			<nav class="navbar">
				<div class="container nav-content">
					<li class="nav-logo"><p>Formularios Web</p></li>
					<ul class="nav-menu">
						<li class="nav-item">
							<a id="btn-print-content" class="btn secondary" href="#"
								>Imprimir</a
							>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		<main class="content-print appross bg-light">
			<div class="appross logo">
				<img src="{{ asset('img/appross_logo.png') }}" alt="logo appross" />
			</div>
			<div class="appross panel-container">
				<div class="panel">
					<div class="title">
						<span class="arrow-right"></span>
						<span>PLANILLA DE ASISTENCIA DIARIA - REHABILITACIÓN</span>
					</div>
					<div class="content">
						<div class="form">
							<div class="row">
								<div class="form-group">
									<span class="form-prepend">profesional:</span>
									<input id="professional" type="text" class="form-input" value="{{ Auth::user()->name . ' ' . Auth::user()->surname }}" />
								</div>
								<div class="form-group">
									<span class="form-prepend">especialidad:</span>
									<input id="specialty" type="text" class="form-input" value="{{ $prestador[0]->prestacion[0]->nombre }}" />
								</div>
							</div>
							<div class="row">
								<div class="form-group" style="width: 40%;">
									<span class="form-prepend">mes:</span>
									<input id="monthly" type="text" class="form-input" value="{{ $mes }}" />
								</div>
								<div class="form-group">
									<span class="form-prepend">dirección:</span>
									<input id="address" type="text" class="form-input" value="{{ Auth::user()->direccion }}" />
								</div>
								<div class="form-group" style="width: 45%;">
									<span class="form-prepend">Teléfono:</span>
									<input id="phone" type="text" class="form-input" value="{{ Auth::user()->telefono }}"/>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<span class="form-prepend">nombre y apellido:</span>
									<input id="names" type="text" class="form-input" value="{{ $beneficiario[0]->nombre }}"/>
								</div>
								<div class="form-group" style="width: 60%">
									<span class="form-prepend">n&uacute;mero de afiliado:</span>
									<input id="filial-number" type="text" class="form-input" value="{{ $beneficiario[0]->numero_afiliado }}" />
								</div>
							</div>
						</div>

						<div class="table-container">
							<table
								id="table-1-aprross"
								class="table table-color table-head-clean"
							>
								<thead>
									<tr role="row">
										<th>fecha</th>
										<th class="text-start" style="text-align: center">hora ingreso</th>
										<th class="text-start" style="text-align: center">hora egreso</th>
										<th>firma del titular y/o responsable</th>
										<th>observaciones</th>
									</tr>
								</thead>
								<tbody>
									<?php $indices = array(); ?>
									@foreach($fechas['total'] as $key => $fecha)
										@foreach($fecha as $dia => $fechaFinal)
											<?php $fechas = explode('/', $fechaFinal); ?>
											<tr>
												<td>
													<div>
														<input style="font-size: 12px" type="text" value="{{ $fechas[0] }}">
														/
														<input style="font-size: 12px" type="text" value="{{ $fechas[1] }}">
														/
														<input style="font-size: 12px" type="text" value="{{ $fechas[2] }}">
													</div>
												</td>

												<td>
													<input style="text-align: center" type="text" value="{{ $fechas[3] }}">
												</td>

												<td>
													<input style="text-align: center" type="text" value="{{ $fechas[4] }}">
												</td>

												<td>
													<input type="text">
												</td>

												<td>
													<input type="text">
												</td>
											</tr>	
										<?php $indices[]++ ?>	
										@endforeach
									@endforeach

									@for ($i = count($indices); $i < 17; $i++)
										<tr>
											<td>
												<div>
													<input type="text">
													/
													<input type="text">
													/
													<input type="text">
												</div>
											</td>

											<td>
												<input type="text">
											</td>

											<td>
												<input type="text">
											</td>

											<td>
												<input type="text">
											</td>

											<td>
												<input type="text">
											</td>
										</tr>
									@endfor
								</tbody>
							</table>
						</div>

						<div class="panel-footer">
							<div class="info">
								<p>
									Las firmas deberán estar consignadas en c/u de los días
									asistidos. De ser un tercero deberá acreditarse vínculo.
								</p>
								<p>
									NO se contemplarán las firmas cruzadas que abarquen más de un
									día.
								</p>
								<p>
									Se considerará una sesión por día, siendo esta de 45 minutos
									como mínimo, y no por asistencia de mayor horario.
								</p>
								<p>
									Los débitos realizados en relación a la falta de datos en las
									planillas de asistencias no serán acreditados.
								</p>
								<p>SIN EXCEPCIÓN.</p>
							</div>
							<div class="signature">
								<span class="line"></span>
								<p>Firma y Sello Profesional</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="appross footer bg-dark">
				<div class="address">
					<p>Sede Central</p>
					<p>Marcelo T. de Alvear 758.</p>
					<p>Bº Güemes - Córdoba</p>
				</div>
				<div class="schedule">
					<p>Horario de atenci&oacute;n</p>
					<p>de 8:00 a 20:00 hs.</p>
				</div>
				<div class="contact">
					<p>Centro de atención al afiliado: 0800 888 2776</p>
					<p>E-mail: comunicaciones.apross@cba.gov.ar</p>
					<p>www.apross.gov.ar</p>
				</div>
			</div>
		</main>

		<script src="{{ asset('js/apross/app.js') }}"></script>
		{{-- <script>
			function createRows(rowsQty, tdQuantity) {
				var table = document.getElementById('table-1-aprross');
				var tBodyElem = table.getElementsByTagName('tbody')[0];

				for (var i = 0; i < rowsQty; i++) {
					var trElem = document.createElement('tr');
					for (var j = 0; j < tdQuantity; j++) {
						var tdElem = document.createElement('td');
						var inputElem = document.createElement('input');
						inputElem.setAttribute('type', 'text');

						if (j === 0) {
							var tdContentElem = document.createElement('div');
							var textElem = document.createTextNode('/');
							for (var k = 0; k < 2; k++) {
								var divTextElem = document.createTextNode('/');
								var divInputElem = document.createElement('input');
								divInputElem.setAttribute('type', 'text');
								tdContentElem.appendChild(divInputElem);
								tdContentElem.appendChild(divTextElem);
							}
							tdContentElem.appendChild(inputElem);
							tdElem.appendChild(tdContentElem);
							trElem.appendChild(tdElem);
							continue;
						}

						tdElem.appendChild(inputElem);
						trElem.appendChild(tdElem);
					}
					tBodyElem.appendChild(trElem);
				}
			}

			createRows(17, 5);
		</script> --}}
	</body>
</html>
