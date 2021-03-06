<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>
			CONSENTIMIENTO DE TRANSPORTE
		</title>
		<link rel="stylesheet" href="{{ asset('css/app_2.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/apross/consent.css') }}" />
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

		<main class="content-print container osecac" style="padding-top: 0rem;">
			<div class="top-line"></div>
			<div class="appross-title">
				<div class="logo">
					<img src="{{ asset('img/logo-white-appross.png') }}" alt="logo appross" />
				</div>
				<div class="top">
					<span>CONSENTIMIENTO DE TRANSPORTE</span>
				</div>
				<div class="top-line"></div>
			</div>

			<div class="title-container">
				<h1 class="title">
					consentimiento de transporte
				</h1>
			</div>

			<div class="form" style="margin-top: 1.5rem; padding: 0 0.5rem">
				<div class="form-group" style="width: 30%; margin-top: 0.4rem;">
					<span class="form-prepend text" style="font-size: 0.8rem;"
						>Fecha de emisión:</span
					>
					<input id="admition-date-day" type="text" class="form-input" value="{{ date('d') }}"/>
					<span class="form-prepend text" style="font-size: 0.8rem;">/</span>
					<input id="admition-date-month" type="text" class="form-input" value="{{ date('m') }}"/>
					<span class="form-prepend text" style="font-size: 0.8rem;">/</span>
					<input id="admition-date-year" type="text" class="form-input" value="{{ date('Y') }}"/>
				</div>
				<div class="row" style="width: 90%;">
					<div class="form-group" style="margin-top: 0.1rem;">
						<span class="form-prepend text" style="font-size: 0.8rem;"
							>Prestador:</span
						>
						<input id="lender" type="text" class="form-input" value="{{ Auth::user()->name . ' ' . Auth::user()->surname }}"/>
					</div>
					<div
						class="form-group"
						style="margin-top: 0.1rem; padding-left: 0.5rem; width: 75%;"
					>
						<span class="form-prepend text" style="font-size: 0.8rem;"
							>CUIT:</span
						>
						<input id="cuit" type="text" class="form-input" value="{{ Auth::user()->cuit }}"/>
					</div>
				</div>
				<div class="form-group" style="margin-top: 0.1rem; width: 90%;">
					<span class="form-prepend text" style="font-size: 0.8rem;"
						>Domicilio:</span
					>
					<input id="address" type="text" class="form-input" value="{{ Auth::user()->direccion }}"/>
				</div>
				<div class="row" style="width: 90%;">
					<div class="form-group" style="margin-top: 0.1rem;">
						<span class="form-prepend text" style="font-size: 0.8rem;"
							>Teléfono:</span
						>
						<input id="phone" type="text" class="form-input" value="{{ Auth::user()->telefono }}"/>
					</div>
					<div
						class="form-group"
						style="margin-top: 0.1rem; padding-left: 0.3rem; width: 150%;"
					>
						<span class="form-prepend text" style="font-size: 0.8rem;"
							>Mail de contacto:</span
						>
						<input id="email" type="text" class="form-input" value="{{ Auth::user()->email }}"/>
					</div>
				</div>
				<div class="row" style="width: 90%;">
					<div class="form-group" style="margin-top: 0.1rem;">
						<span class="form-prepend text" style="font-size: 0.8rem;"
							>Compañía de Seguros:</span
						>
						<input id="company" type="text" class="form-input" value="{{ Auth::user()->emp_seguros }}"/>
					</div>
					<div
						class="form-group"
						style="margin-top: 0.1rem; padding-left: 0.2rem;"
					>
						<span class="form-prepend text" style="font-size: 0.8rem;"
							>Póliza Nº:</span
						>
						<input id="policy" type="text" class="form-input" value="{{ Auth::user()->poliza }}"/>
					</div>
				</div>
			</div>

			<div class="form" style="margin-top: 1.5rem; padding: 0 0.5rem;">
				<div class="form-group" style="margin-top: 0.5rem;">
					<span class="text small" style="width: 100%; font-size: 0.5rem;"
						>Tomo conocimiento que la falta de alguno de los datos aquí
						requeridos imposibilitan mi alta como prestador y la emisión de la
						correspondiente autorización</span
					>
				</div>
				<div class="row" style="width: 80%;">
					<div class="form-group" style="margin-top: 0">
						<span class="form-prepend text" style="font-size: 0.8rem;"
							>Beneficiario:</span
						>
						<input id="beneficiary" type="text" class="form-input" value="{{ $beneficiario[0]->nombre }}"/>
					</div>
					<div
						class="form-group"
						style="margin-top: 0rem; padding-left: 0.5rem; width: 75%;"
					>
						<span class="form-prepend text" style="font-size: 0.8rem;"
							>DNI:</span
						>
						<input
							id="dni"
							type="text"
							class="form-input"
							style="margin-left: 0.5rem;"
							value="{{ $beneficiario[0]->dni }}"
						/>
					</div>
				</div>
				<div class="form-group" style="margin-top: 0.3rem; width: 80%;">
					<span class="form-prepend text" style="font-size: 0.8rem;"
						>Prestación a brindar Transporte Especial a:</span
					>
					<input id="transport-benefit" type="text" class="form-input" value="{{ $prestador[0]->prestacion[0]->nombre }}"/>
				</div>
				<div class="row" style="margin-top: 0.4rem; width: 70%;">
					<div class="form-group" style="margin-top: 0.4rem;">
						<span class="form-prepend text" style="font-size: 0.8rem;"
							>Período:</span
						>
						<input id="period" type="text" class="form-input" value="{{ $mes .' a Diciembre ' . date('Y')  }}"/>
					</div>
					<div
						class="form-group"
						style="margin-top: 0.3rem; padding-left: 1.5rem;"
					>
						<span
							class="form-prepend text"
							style="transform: translateY(-70%); font-size: 0.8rem;"
							>(Tipo de prestación o institución)
						</span>
					</div>
				</div>
			</div>

			<div class="table-content" style="margin-top: 0.8rem;">
				<table class="table">
					<tbody>
						<tr>
							<td style="position: relative; padding: 0 0.5rem;">
								<span
									class="text bolder"
									style="position: absolute; top: 0.15rem; left: 0.5rem; line-height: 12px; font-size: 0.95rem; border-bottom: 1px solid #212121;"
									>IDA:</span
								>
								<div
									class="form"
									style="position: relative; top: -15%; left: 15%; width: 70%; margin-top: 0.8rem;"
								>
									<div
										class="form-group"
										style="width: 100%; margin-top: 0.3rem;"
									>
										<span class="form-prepend text" style="font-size: 0.8rem;"
											>Desde:</span
										>
										<input id="from-going" type="text" class="form-input" value="{{ $beneficiario[0]->direccion}}"/>
									</div>
									<div
										class="form-group"
										style="width: 100%; margin-top: 0.3rem;"
									>
										<span class="form-prepend text" style="font-size: 0.8rem;"
											>Hasta:</span
										>
										<input id="to-going" type="text" class="form-input" value="{{ $beneficiario[0]->direccion_prestacion }}"/>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="table-content" style="margin-top: 0rem;">
				<table class="table">
					<thead>
						<tr>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Días
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Lunes
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Martes
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Miércoles
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Jueves
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Viernes
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Sábado
							</th>
						</tr>
					</thead>
					<tbody>
						<tr style="height: 27.5px;">
							<td
								class="text bolder"
								style="width: 115px; text-align: center; vertical-align: bottom;"
							>
								Horario
							</td>
							<td>
								<input id="going-schedule-1" type="text" class="table-input" />
							</td>
							<td>
								<input id="going-schedule-2" type="text" class="table-input" />
							</td>
							<td>
								<input id="going-schedule-3" type="text" class="table-input" />
							</td>
							<td>
								<input id="going-schedule-4" type="text" class="table-input" />
							</td>
							<td>
								<input id="going-schedule-5" type="text" class="table-input" />
							</td>
							<td>
								<input id="going-schedule-6" type="text" class="table-input" />
							</td>
						</tr>
						<tr style="height: 27.5px;">
							<td
								class="text bolder"
								style="width: 115px; text-align: center; vertical-align: top;"
							>
								Km ida
							</td>
							<td><input id="going-km-1" type="text" class="table-input" /></td>
							<td><input id="going-km-2" type="text" class="table-input" /></td>
							<td><input id="going-km-3" type="text" class="table-input" /></td>
							<td><input id="going-km-4" type="text" class="table-input" /></td>
							<td><input id="going-km-5" type="text" class="table-input" /></td>
							<td><input id="going-km-6" type="text" class="table-input" /></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="table-content" style="margin-top: 0rem;">
				<table class="table">
					<tbody>
						<tr>
							<td
								style="position: relative; padding: 0 0.5rem; border-top: none;"
							>
								<span
									class="text bolder"
									style="position: absolute; top: 0.15rem; left: 0.5rem; line-height: 12px; font-size: 0.95rem; border-bottom: 1px solid #212121;"
									>VUELTA:</span
								>
								<div
									class="form"
									style="position: relative; top: -15%; left: 15%; width: 70%; margin-top: 0.8rem;"
								>
									<div
										class="form-group"
										style="width: 100%; margin-top: 0.4rem;"
									>
										<span class="form-prepend text" style="font-size: 0.8rem;"
											>Desde:</span
										>
										<input id="from-back" type="text" class="form-input" value="{{ $beneficiario[0]->direccion_prestacion }}"/>
									</div>
									<div
										class="form-group"
										style="width: 100%; margin-top: 0.4rem;"
									>
										<span class="form-prepend text" style="font-size: 0.8rem;"
											>Hasta:</span
										>
										<input id="to-back" type="text" class="form-input" value="{{ $beneficiario[0]->direccion }}"/>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="table-content" style="margin-top: 0rem;">
				<table class="table">
					<thead>
						<tr>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Días
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Lunes
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Martes
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Miércoles
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Jueves
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Viernes
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Sábado
							</th>
						</tr>
					</thead>
					<tbody>
						<tr style="height: 27.5px;">
							<td
								class="text bolder"
								style="width: 115px; text-align: center; vertical-align: bottom;"
							>
								Horario
							</td>
							<td>
								<input id="back-schedule-1" type="text" class="table-input" />
							</td>
							<td>
								<input id="back-schedule-2" type="text" class="table-input" />
							</td>
							<td>
								<input id="back-schedule-3" type="text" class="table-input" />
							</td>
							<td>
								<input id="back-schedule-4" type="text" class="table-input" />
							</td>
							<td>
								<input id="back-schedule-5" type="text" class="table-input" />
							</td>
							<td>
								<input id="back-schedule-6" type="text" class="table-input" />
							</td>
						</tr>
						<tr style="height: 27.5px;">
							<td
								class="text bolder"
								style="width: 115px; text-align: center; vertical-align: top;"
							>
								Km ida
							</td>
							<td><input id="back-km-1" type="text" class="table-input" /></td>
							<td><input id="back-km-2" type="text" class="table-input" /></td>
							<td><input id="back-km-3" type="text" class="table-input" /></td>
							<td><input id="back-km-4" type="text" class="table-input" /></td>
							<td><input id="back-km-5" type="text" class="table-input" /></td>
							<td><input id="back-km-6" type="text" class="table-input" /></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="table-content" style="margin-top: 0rem;">
				<table class="table">
					<tbody>
						<tr>
							<td
								style="display:flex; justify-content: center; height: 22px; padding: 0 0.2rem; border-top: none;"
							>
								<span
									class="text bolder"
									style="margin-bottom: 3px; font-size: 0.95rem; border-bottom: 1px solid #212121;"
									>TOTALES KM DIARIOS</span
								>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="table-content" style="margin-top: 0rem;">
				<table class="table">
					<thead>
						<tr>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Días
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Lunes
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Martes
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Miércoles
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Jueves
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Viernes
							</th>
							<th
								class="text"
								style="border-top: none; vertical-align: top; padding-bottom: 0.1rem;"
							>
								Sábado
							</th>
						</tr>
					</thead>
					<tbody>
						<tr style="height: 27.5px;">
							<td
								class="text bolder"
								style="width: 115px; text-align: center; vertical-align: bottom;"
							>
								<p class="text bolder">Km Ida+ Km</p>
								<p class="text bolder">Vuelta</p>
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="table-content" style="margin-top: 0rem;">
				<table class="table">
					<tbody>
						<tr>
							<td
								style="display:flex; justify-content: center; height: 24px; padding: 0.2rem; border-top: none;"
							>
								<span
									class="text bolder"
									style="margin-bottom: 3px; font-size: 0.9rem;"
									>Total Km. Mensuales:</span
								>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="form" style="margin-top: 0.2rem; padding: 0 0.5rem">
				<div class="row" style="width: 62.5%;">
					<div class="form-group" style="width: 50%; margin-top: 0;">
						<span class="form-prepend text" style="font-size: 0.8rem;"
							>Días mensuales (hasta)</span
						>
						<input id="monthly-days" type="text" class="form-input" />
					</div>
					<div class="form-group" style="margin-top: 0.4rem; width: 50%;">
						<span class="form-prepend text" style="font-size: 0.8rem;"
							>Viajes mensuales (hasta)</span
						>
						<input id="monthly-trips" type="text" class="form-input" />
					</div>
				</div>
				<div
					class="row"
					style="width: 95%; justify-content: space-between; align-items: center;"
				>
					<div
						class="form-group"
						style="width: 50%; margin-top: 0.6rem; align-items: center;"
					>
						<span class="form-prepend text" style="font-size: 0.8rem;"
							>Adicional dependencia 35% (Sujeto a evaluación):</span
						>
						<div class="form-group" style="margin-top: 0; padding-left: 20px;">
							<span class="text" style="font-size: 0.8rem;">SI</span>
							<div
								style="width: 20px; height: 20px; margin: 0 0.4rem; text-align: center; font-size: 1.1rem; cursor: pointer;"
								onclick="AppClass.bindInputCheck(event)"
								data-checked="0"
							></div>
						</div>
						<div class="form-group" style="margin-top: 0;">
							<span class="text" style="font-size: 0.8rem;">NO</span>
							<div
								style="width: 20px; height: 20px; margin: 0 0.4rem; text-align: center; font-size: 1.1rem; cursor: pointer;"
								onclick="AppClass.bindInputCheck(event)"
								data-checked="0"
							></div>
						</div>
					</div>
				</div>
				<div
					class="form-group"
					style="width: 95%; justify-content: space-between; margin-top: 0.8rem; padding-left: 3.5rem;"
				>
					<span
						class="form-prepend text bolder"
						style="width: 40%; font-size: 0.75rem; padding: 0.25rem 0.4rem; border: 2px solid #212121;"
						>Consentimiento</span
					>
				</div>
				<div class="form-group" style="margin-top: 0.2rem;">
					<p
						class="text"
						style="width: 100%; text-align: justify; font-size: 0.67rem;"
					>
						Por la presente dejo constancia de mi consentimiento al esquema de
						transporte descripto precedentemente al beneficiario:
					</p>
				</div>
				<div class="row" style="width: 92%;">
					<div class="form-group" style="margin-top: 0">
						<span class="form-prepend text" style="font-size: 0.8rem;"></span>
						<input id="beneficiary-text" type="text" class="form-input" />
					</div>
					<div
						class="form-group"
						style="margin-top: 0rem; padding-left: 0.5rem; width: 50%;"
					>
						<span class="form-prepend text" style="font-size: 0.8rem;"
							>DNI:</span
						>
						<input id="dni-2" type="text" class="form-input" />
					</div>
				</div>
				<div
					class="form-group"
					style="width: 92%; margin-top: 2.5rem; padding-left: 3rem;"
				>
					<div
						class="form-prepend text center"
						style="display: flex; flex-flow: column; align-items: flex-end;"
					>
						<span
							style="display: block; width: 96%; border-top: 1px solid #212121;"
						></span>
						<span style="font-size: 0.6rem; text-align: end;"
							>Firma y Aclaración Beneficiario o representante</span
						>
					</div>

					<div class="form-prepend text center" style="margin-left: 27%;">
						<span
							style="display: block; width: 120%; border-top: 1px solid #212121;"
						></span>
						<span
							style="display: block; width: 120%; font-size: 0.6rem; text-align: center;"
							>Firma y Aclaración del Transportista</span
						>
					</div>
				</div>
			</div>

			<footer>
				<p>CENTRO DE ATENCION AL AFILIADO 0 800 888 2776</p>
				<p>|</p>
				<p>Email: comunicaciones.apross@cba.gov.ar</p>
			</footer>
			<div class="top-line"></div>
		</main>

		<script src="{{ asset('js/apross/app.js') }}"></script>
	</body>
</html>
