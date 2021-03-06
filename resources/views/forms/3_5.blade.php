<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>
			3.5 Planilla de Asistencia Mensual - Maestro de Apoyo (valor módulo)
		</title>
		<link rel="stylesheet" href="{{asset('css/osecac/app.css')}}" />
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
						<li class="nav-item">
							<a class="btn primary dropdown" href="#">Menu</a>
							<div class="dropdown-items">
								<a
									class="dropdown-item"
									href="#osecac"
									onclick="AppClass.bindContentLinkClick(event)"
									>osecac</a
								>
								<a
									class="dropdown-item"
									href="#apross"
									onclick="AppClass.bindContentLinkClick(event)"
									>apross</a
								>
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		<main class="content-print container osecac" style="padding-top: 3rem;">
			<h1 class="title" style="font-size: 0.8rem">
				3.5 Planilla de Asistencia Mensual - Maestro de Apoyo (valor módulo)
			</h1>

			<div class="form" style="margin-top: 1.5rem;">
				<div class="form-group" style="margin-top: 0.8rem;">
					<span class="form-prepend text">Prestador:</span>
				<input id="lender" type="text" class="form-input" value="{{Auth::user()->name . ' ' . Auth::user()->surname}}"/>
				</div>
				<div class="form-group" style="margin-top: 0.8rem;">
					<span class="form-prepend text">Domicilio:</span>
					<input id="address" type="text" class="form-input" value="{{Auth::user()->direccion . ' - ' . Auth::user()->provincia}}"/>
				</div>

				<div class="row">
					<div class="form-group" style="margin-top: 0.8rem;">
						<span class="form-prepend text">Correo Electrónico</span>
						<input id="email" type="text" class="form-input" value="{{Auth::user()->email}}"/>
					</div>
					<div
						class="form-group"
						style="margin-top: 0.8rem;"
						style="padding-left: 0.5rem; width: 60%;"
					>
						<span class="form-prepend text"
							>Tel</span
						>
						<input id="phone" type="text" class="form-input" value="{{Auth::user()->telefono}}"/>
					</div>
				</div>
				<div class="form-group" style="margin-top: 0.8rem;">
					<span class="form-prepend text"
						>Apellido y Nombre del beneficiario:</span
					>
					<input id="names" type="text" class="form-input" value="{{$beneficiario[0]->nombre}}"/>
				</div>
				<div class="form-group" style="margin-top: 0.8rem;">
					<span class="form-prepend text">DNI:</span>
					<input
						id="dni"
						type="text"
						class="form-input"
						style="flex-basis: 25%; width: 25%;"
						value="{{$beneficiario[0]->dni}}"
					/>
				</div>
				<div class="form-group" style="margin-top: 0.8rem;">
					<span class="form-prepend text">Prestación:</span>
					<input id="benefit" type="text" class="form-input" value="{{$prestador[0]->prestacion[0]->nombre}}"/>
				</div>
				<div class="form-group" style="margin-top: 0.8rem;">
					<span class="form-prepend text">Periodo (mes y año):</span>
					<input
						id="period"
						type="text"
						class="form-input"
						style="flex-basis: 45%; width: 45%;"
						value="{{Auth::user()->mes . ' / ' . Auth::user()->anio}}"
					/>
				</div>
				<div class="row">
					<div class="form-group" style="margin-top: 1.75rem; width: 50%;">
						<span class="form-prepend text">Carga horaria mensual:</span>
						@php
							$time = array();
							$total = 0;
							foreach($fechas['total'][$beneficiario[0]->id] ?? [] as $k => $v){
								$v = explode('/', $v);
								$fechaInicial = new DateTime($v[3]);
								$fechaFinal = new DateTime($v[4]);
								$interval = $fechaInicial->diff($fechaFinal);
								$interval = $interval->format('%H:%I:%S');
								$time[] = $interval;
							}

							foreach($time as $element){
								// Explode by seperator : 
								$temp = explode(":", $element); 
								
								// Convert the hours into seconds 
								// and add to total 
								$total+= (int) $temp[0] * 3600; 
									
								// Convert the minutes to seconds 
								// and add to total 
								$total+= (int) $temp[1] * 60; 
									
								// Add the seconds to total 
								$total+= (int) $temp[2]; 	
							}
								
								// Format the seconds back into HH:MM:SS 
								$formatted = sprintf('%02d:%02d',  
												($total / 3600), 
												($total / 60 % 60)); 
						@endphp
						<input id="workload" type="text" class="form-input" value="{{$formatted ?? ''}}"/>
					</div>
					<div
						class="form-group"
						style="margin-top: 0.8rem; padding-left: 0.5rem;"
					>
						<span class="form-prepend text">
							hs, de acuerdo al siguiente detalle (*)
						</span>
					</div>
				</div>
			</div>

			<div class="table-content container" style="margin-top: 1.5rem;">
				<table id="3.4-form-table-1" class="table">
					<thead>
						<tr>
							@for ($i = 1; $i < 16; $i++)
								<th style="font-size: 1rem; font-weight: 400;">{{$i}}</th>
							@endfor
						</tr>
					</thead>
					<tbody>
						<tr>
							@for ($i = 1; $i < 16; $i++)
								<td style="height: 37.5px">
									@php
										if($i < 10){
											$index = 0 . $i;
										}else{
											$index = $i;
										}
										if(isset($fechas['total'][$beneficiario[0]->id][$index])){
											$fechasExploded = explode('/', $fechas['total'][$beneficiario[0]->id][$index]);
											$fechaInicial = new DateTime($fechasExploded[3]);
											$fechaFinal = new DateTime($fechasExploded[4]);
											$interval = $fechaInicial->diff($fechaFinal);
											$interval = $interval->format('%H:%I') . ' hs';
										}else{
											$interval = '';
										}	
									@endphp
									<input type="text" id="table-input-{{$i}}" class="table-input" value="{{$interval ?? ''}}">
								</td>
							@endfor
						</tr>
					</tbody>
				</table>
			</div>

			<div class="table-content container" style="margin-top: 2rem;">
				<table id="3.4-form-table-2" class="table">
					<thead>
						<tr>
							@for ($i = 16; $i < 32; $i++)
								<th style="font-size: 1rem; font-weight: 400; padding: 0;">{{$i}}</th>
							@endfor
						</tr>
					</thead>
					<tbody>
						<tr>
							@for ($i = 16; $i < 32; $i++)
								<td style="height: 37.5px">
									@php
										if($i < 10){
											$index = 0 . $i;
										}else{
											$index = $i;
										}
										if(isset($fechas['total'][$beneficiario[0]->id][$index])){
											$fechasExploded = explode('/', $fechas['total'][$beneficiario[0]->id][$index]);
											$fechaInicial = new DateTime($fechasExploded[3]);
											$fechaFinal = new DateTime($fechasExploded[4]);
											$interval = $fechaInicial->diff($fechaFinal);
											$interval = $interval->format('%H:%I') . ' hs';
										}else{
											$interval = '';
										}		
									@endphp
									<input type="text" id="table-input-{{$i}}" class="table-input" value="{{$interval ?? ''}}">
								</td>
							@endfor
						</tr>
					</tbody>
				</table>
			</div>

			<div class="form" style="margin-top: 1.5rem;">
				<div class="form-group" style="margin-top: 0.2rem;">
					<span class="form-prepend text"
						>(*) Se debe indicar la carga horaria día por día (no el horario),
						Ej.: 4 hs no de 8.00 a 12.00 hs
					</span>
				</div>
				<div class="form-group" style="margin-top: 3rem;">
					<span class="form-prepend text"
						>Lugar donde se realiza la integración:
					</span>
					<input id="place" type="text" class="form-input" value="{{$beneficiario[0]->direccion_prestacion}}"/>
				</div>
				<div class="form-group" style="margin-top: 0.8rem; width: 75%;">
					<span class="form-prepend text">Turno (mañana/tarde/doble):</span>
					<input id="appoinment" type="text" class="form-input" value="{{$beneficiario[0]->turno}}"/>
				</div>
			</div>

			<div class="table-content container" style="margin-top: 2rem;">
				<table id="3.4-form-table-2" class="table">
					<thead>
						<tr>
							<th class="text">Prestador</th>
							<th class="text">Paciente o responsable</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td
								style="width: 33%; height: 90px; font-size: 0.8rem; text-align: center; vertical-align: bottom; padding: 0.1rem 0.8rem;"
							>
								Firma del profesional que realiza la integración
							</td>
							<td
								style="width: 33%; height: 90px; font-size: 0.8rem; text-align: center; vertical-align: bottom; padding: 0.1rem 0.2rem;"
							>
								Firma
							</td>
						</tr>
						<tr>
							<td
								style="width: 33%; height: 60px; font-size: 0.8rem; text-align: center; vertical-align: bottom; padding: 0.1rem 0.2rem;"
							>
								Sello o Aclaración
							</td>
							<td style="width: 33%;">
								<div
									style="display: flex; align-items: flex-end; height: 30px; padding-left: 0.5rem; font-size: 0.8rem; border-bottom: 1px solid #070707;"
								>
									Aclaración
								</div>
								<div
									style="display: flex; align-items: flex-end; height: 30px; padding-left: 0.5rem; font-size: 0.8rem; border-bottom: 1px solid #070707;"
								>
									DNI
								</div>
								<div
									style="display: flex; align-items: flex-end; height: 30px; padding-left: 0.5rem; font-size: 0.8rem;"
								>
									Vínculo
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<footer style="margin-top: 5rem;">
				<div class="footer-line dark"></div>
				<div
					class="footer-line light"
					style="height: 1px; margin-top: 0.05rem;"
				></div>
				<p class="text" style="margin-top: 0.2rem">
					Subsidios por Discapacidad {{date('Y')}}
				</p>
			</footer>
		</main>

		<script src="{{asset('js/osecac/app.js')}}"></script>
		{{-- <script>
			AppClass.createNumberThRows(
				'3.4-form-table-1',
				'font-size: 1rem; font-weight: 400;',
				15
			);
			AppClass.createTableRows('3.4-form-table-1', 1, 15, [], 37.5);

			AppClass.createNumberThRows(
				'3.4-form-table-2',
				'font-size: 1rem; font-weight: 400; padding: 0;',
				16,
				15
			);
			AppClass.createTableRows('3.4-form-table-2', 1, 16, [], 37.5);
		</script> --}}
	</body>
</html>
