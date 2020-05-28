<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>
			Laravel OS - Presupuesto
		</title>
		<link rel="stylesheet" href="{{asset('css/form.css') }}"/>
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

		<main class="content-print container osecac" style="padding-top: 1.5rem;">
			<h1 class="title" style="font-size: 0.8rem">
				Anexo 8.4 Presupuesto Tratamientos / Maestra de Apoyo
			</h1>

			<div class="form" style="margin-top: 0.5rem; padding: 0 0.5rem">
				<div class="form-group" style="width: 30%; margin-top: 0.4rem;">
					<span class="form-prepend text">Fecha de emisión:</span>
					<input type="text" class="form-input" value="{{ date('d-m-Y') }}" />
				</div>
				<div class="row">
					<div class="form-group" style="margin-top: 1.5rem;">
						<span class="form-prepend text">Prestador:</span>
						<input type="text" class="form-input" value="{{ $prestador[0]->user->name . ' ' . $prestador[0]->user->surname }}" />
					</div>
					<div
						class="form-group"
						style="margin-top: 0.5rem; padding-left: 0.5rem; width: 75%;"
					>
						<span class="form-prepend text">CUIT:</span>
						<input type="text" class="form-input" value="{{ $prestador[0]->user->cuit }}"/>
					</div>
				</div>
				<div class="form-group" style="margin-top: 0.5rem;">
					<span class="form-prepend text">Domicilio de atención:</span>
					<input type="text" class="form-input" value="{{ $beneficiario->direccion_prestacion }}" />
				</div>
				<div class="row">
					<div class="form-group" style="margin-top: 0.5rem;">
						<span class="form-prepend text">Teléfono:</span>
						<input type="text" class="form-input" value="{{ $prestador[0]->user->telefono }}" />
					</div>
					<div
						class="form-group"
						style="margin-top: 0.5rem; padding-left: 1.5rem; width: 150%;"
					>
						<span class="form-prepend text">Mail de contacto:</span>
						<input type="text" class="form-input" value="{{ $prestador[0]->user->email }}" />
					</div>
				</div>
				<div class="form-group" style="margin-top: 0.5rem;">
					<span class="form-prepend text">Orden de emisión de cheque:</span>
					<input type="text" class="form-input" value="{{ $prestador[0]->user->orden_cheque }}" />
				</div>
				<div class="row">
					<div class="form-group" style="margin-top: 0.5rem;">
						<span class="form-prepend text">Entidad Bancaria:</span>
						<input type="text" class="form-input" value="{{ $prestador[0]->user->entidad_bancaria }}" />
					</div>
					<div
						class="form-group"
						style="margin-top: 0.5rem; padding-left: 0.3rem; width: 130%;"
					>
						<span class="form-prepend text">(CBU):</span>
						<input type="text" class="form-input" value="{{ $prestador[0]->user->cbu }}" />
					</div>
				</div>
				<div class="form-group" style="width: 55%; margin-top: 0.5rem;">
					<span class="form-prepend text">Lugar de Pago (Delegación):</span>
					<input type="text" class="form-input" value="{{ $prestador[0]->user->lugar_pago }}" />
				</div>
			</div>

			<div class="form" style="margin-top: 2rem; padding: 0 0.5rem">
				<div
					class="row"
					style="justify-content: space-between; align-items: center;"
				>
					<span class="text">Condición frente a</span>
					<span class="text">IVA:</span>
					<div
						class="form-group"
						style="width: 60%; align-items: center; justify-content: space-between; margin-top: 0;"
					>
						<div class="form-group" style="width: 70%; margin-top: 0;">
							<span class="text">Inscripto</span>
							<div
								style="width: 20px; height: 20px; margin-left: 0.4rem; border: 1px solid #212121; text-align: center; font-size: 1.1rem; cursor: pointer;"
								onclick="AppClass.bindInputCheck(event)"
								data-checked="0"
							></div>
						</div>
						<div class="form-group" style="margin-top: 0;">
							<span class="text">Monotributo</span>
							<div
								style="width: 20px; height: 20px; margin-left: 1.5rem; border: 1px solid #212121; text-align: center; font-size: 1.1rem; cursor: pointer;"
								onclick="AppClass.bindInputCheck(event)"
								data-checked="0"
							></div>
						</div>
						<div class="form-group" style="margin-top: 0;">
							<span class="text">Exento</span>
							<div
								style="width: 20px; height: 20px; margin-left: 0.6rem; border: 1px solid #212121; text-align: center; font-size: 1.1rem; cursor: pointer;"
								onclick="AppClass.bindInputCheck(event)"
								data-checked="0"
							></div>
						</div>
					</div>
				</div>
				<div
					class="row"
					style="justify-content: space-between; align-items: center; margin-top: 1.5rem;"
				>
					<span class="text">Condición frente a</span>
					<span class="text">Ing. Brutos:</span>
					<div
						class="form-group"
						style="width: 60%; align-items: center; justify-content: space-between; margin-top: 0;"
					>
						<div class="form-group" style="width: 70%; margin-top: 0;">
							<span class="text">Inscripto</span>
							<div
								style="width: 20px; height: 20px; margin-left: 0.4rem; border: 1px solid #212121; text-align: center; font-size: 1.1rem; cursor: pointer;"
								onclick="AppClass.bindInputCheck(event)"
								data-checked="0"
							></div>
						</div>
						<div class="form-group" style="margin-top: 0;">
							<span class="text">Conv. Multilat</span>
							<div
								style="width: 20px; height: 20px; margin-left: 1rem; border: 1px solid #212121; text-align: center; font-size: 1.1rem; cursor: pointer;"
								onclick="AppClass.bindInputCheck(event)"
								data-checked="0"
							></div>
						</div>
						<div class="form-group" style="margin-top: 0;">
							<span class="text">Exento</span>
							<div
								style="width: 20px; height: 20px; margin-left: 0.6rem; border: 1px solid #212121; text-align: center; font-size: 1.1rem; cursor: pointer;"
								onclick="AppClass.bindInputCheck(event)"
								data-checked="0"
							></div>
						</div>
					</div>
				</div>
				<div
					class="form-group"
					style="width: 79%; margin-top: 0.5rem; justify-content: flex-end;"
				>
					<span class="form-prepend text">Nº IIBB:</span>
					<input
						id="iibb"
						type="text"
						class="form-input"
						style="flex-basis: 40%; width: 40%;"
					/>
				</div>
				<div class="form-group" style="margin-top: 0.8rem;">
					<span class="text small"
						>Tomo conocimiento que la falta de alguno de los datos aquí
						requeridos imposibilitan mi alta como prestador y la emisión de la
						correspondiente autorización.</span
					>
				</div>
			</div>

			<div class="form" style="margin-top: 0.7rem; padding: 0 0.5rem">
				<div class="row">
					<div class="form-group" style="margin-top: 0">
						<span class="form-prepend text">Beneficiario Causante:</span>
						<input id="beneficiary" type="text" class="form-input" />
					</div>
					<div
						class="form-group"
						style="margin-top: 0.5rem; padding-left: 0.5rem; width: 75%;"
					>
						<span class="form-prepend text">DNI:</span>
						<input
							id="dni"
							type="text"
							class="form-input"
							style="margin-left: 0.5rem;"
						/>
					</div>
				</div>
				<div class="form-group" style="width: 70%; margin-top: 0.5rem;">
					<span class="form-prepend text">Prestación / Especialidad:</span>
					<input id="specialty" type="text" class="form-input" />
				</div>
				<div class="row">
					<div class="form-group" style="margin-top: 0.5rem;">
						<span class="form-prepend text">Período:</span>
						<input id="period" type="text" class="form-input" />
					</div>
					<div
						class="form-group"
						style="margin-top: 0.5rem; padding-left: 1.5rem; width: 50%;"
					>
						<span class="form-prepend text">Año:</span>
						<input id="year" type="text" class="form-input" />
					</div>
					<div
						class="form-group"
						style="margin-top: 0.5rem; padding-left: 1.5rem; width: 130%;"
					>
						<span class="form-prepend text"
							>Cantidad de sesiones mensuales:
						</span>
						<input id="sessions-quantity" type="text" class="form-input" />
					</div>
				</div>
				<div class="row" style="justify-content: space-between;">
					<div class="form-group" style="margin-top: 0.5rem; width: 45%;">
						<span class="form-prepend text">Monto Sesión:</span>
						<input id="session-ammount" type="text" class="form-input" />
					</div>
					<div
						class="form-group"
						style="margin-top: 0.5rem; width: 50%; justify-content: flex-end;"
					>
						<span class="form-prepend text">Monto Mensual:</span>
						<input
							id="month-ammount"
							type="text"
							class="form-input"
							style="flex-basis: 60%; width: 60%;"
						/>
					</div>
				</div>
				<div class="form-group" style="width: 55%; margin-top: 1rem;">
					<span class="form-prepend text"
						>Cronograma de asistencia: indicar el horario en cada día de
						asistencia (excluyente)</span
					>
				</div>
			</div>

			<div class="table-content container" style="margin-top: 1.5rem;">
				<table
					class="table"
					style="border-left: 2px solid #212121; border-right: 2px solid #212121;"
				>
					<thead>
						<tr style="border-top: 2px solid #212121;">
							<th class="text bolder" style="border-right: 2px solid #212121;">
								Días
							</th>
							<th class="text" style="font-weight: 500;">Lunes</th>
							<th class="text" style="font-weight: 500;">Martes</th>
							<th class="text" style="font-weight: 500;">Miércoles</th>
							<th class="text" style="font-weight: 500;">Jueves</th>
							<th class="text" style="font-weight: 500;">Viernes</th>
							<th class="text" style="font-weight: 500;">Sábado</th>
						</tr>
					</thead>
					<tbody>
						<tr style="border-bottom: 2px solid #212121;">
							<td class="text bolder" style="border-right: 2px solid #212121;">
								Horario
							</td>
							<td>
								<p
									style="display: flex; margin: 10px 0 10px 4px;"
									class="text small"
									style="padding-top: 0.6rem;"
								>
									De:
									<input
										style="display: inline-block; text-align: left; font-size: 0.7rem"
										id="from-1"
										type="text"
										class="table-input"
									/>
								</p>
								<p
									style="display: flex; margin: 10px 0 10px 4px;"
									class="text small"
									style="padding-top: 0.8rem;"
								>
									A:
									<input
										style="display: inline-block; text-align: left; font-size: 0.7rem"
										id="to-1"
										type="text"
										class="table-input"
									/>
								</p>
							</td>
							<td>
								<p
									style="display: flex; margin: 10px 0 10px 4px;"
									class="text small"
									style="padding-top: 0.6rem;"
								>
									De:
									<input
										style="display: inline-block; text-align: left; font-size: 0.7rem"
										id="from-2"
										type="text"
										class="table-input"
									/>
								</p>
								<p
									style="display: flex; margin: 10px 0 10px 4px;"
									class="text small"
									style="padding-top: 0.8rem;"
								>
									A:
									<input
										style="display: inline-block; text-align: left; font-size: 0.7rem"
										id="to-2"
										type="text"
										class="table-input"
									/>
								</p>
							</td>
							<td>
								<p
									style="display: flex; margin: 10px 0 10px 4px;"
									class="text small"
									style="padding-top: 0.6rem;"
								>
									De:
									<input
										style="display: inline-block; text-align: left; font-size: 0.7rem"
										id="from-3"
										type="text"
										class="table-input"
									/>
								</p>
								<p
									style="display: flex; margin: 10px 0 10px 4px;"
									class="text small"
									style="padding-top: 0.8rem;"
								>
									A:
									<input
										style="display: inline-block; text-align: left; font-size: 0.7rem"
										id="to-3"
										type="text"
										class="table-input"
									/>
								</p>
							</td>
							<td>
								<p
									style="display: flex; margin: 10px 0 10px 4px;"
									class="text small"
									style="padding-top: 0.6rem;"
								>
									De:
									<input
										style="display: inline-block; text-align: left; font-size: 0.7rem"
										id="from-4"
										type="text"
										class="table-input"
									/>
								</p>
								<p
									style="display: flex; margin: 10px 0 10px 4px;"
									class="text small"
									style="padding-top: 0.8rem;"
								>
									A:
									<input
										style="display: inline-block; text-align: left; font-size: 0.7rem"
										id="to-4"
										type="text"
										class="table-input"
									/>
								</p>
							</td>
							<td>
								<p
									style="display: flex; margin: 10px 0 10px 4px;"
									class="text small"
									style="padding-top: 0.6rem;"
								>
									De:
									<input
										style="display: inline-block; text-align: left; font-size: 0.7rem"
										id="from-5"
										type="text"
										class="table-input"
									/>
								</p>
								<p
									style="display: flex; margin: 10px 0 10px 4px;"
									class="text small"
									style="padding-top: 0.8rem;"
								>
									A:
									<input
										style="display: inline-block; text-align: left; font-size: 0.7rem"
										id="to-5"
										type="text"
										class="table-input"
									/>
								</p>
							</td>
							<td>
								<p
									style="display: flex; margin: 10px 0 10px 4px;"
									class="text small"
									style="padding-top: 0.6rem;"
								>
									De:
									<input
										style="display: inline-block; text-align: left; font-size: 0.7rem"
										id="from-6"
										type="text"
										class="table-input"
									/>
								</p>
								<p
									style="display: flex; margin: 10px 0 10px 4px;"
									class="text small"
									style="padding-top: 0.8rem;"
								>
									A:
									<input
										style="display: inline-block; text-align: left; font-size: 0.7rem"
										id="to-6"
										type="text"
										class="table-input"
									/>
								</p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="form" style="margin-top: 5rem; padding: 0 0.5rem">
				<div
					class="form-group"
					style="width: 95%; justify-content: space-between; margin-top: 1rem;"
				>
					<span
						class="form-prepend text center"
						style="width: 35%; border-top: 1px solid #212121;"
						>Firma Responsable</span
					>
					<span
						class="form-prepend text center"
						style="width: 35%; border-top: 1px solid #212121;"
						>Aclaración</span
					>
				</div>
				<div
					class="form-group"
					style="width: 95%; justify-content: space-between; margin-top: 2rem;"
				>
					<span
						class="form-prepend text bolder"
						style="width: 35%; padding: 0.25rem 0.8rem; border: 2px solid #212121;"
						>Consentimiento</span
					>
				</div>
				<div class="form-group" style="margin-top: 1.5rem;">
					<p
						class="text"
						style="width: 100%; text-align: justify; text-align-last: justify;"
					>
						Por la presente dejo constancia de mi consentimiento al programa de
						prestaciones descripto
					</p>
				</div>
				<div class="row">
					<div class="form-group" style="margin-top: 0">
						<span class="form-prepend text"
							>precedentemente al beneficiario:</span
						>
						<input id="previously" type="text" class="form-input" />
					</div>
					<div
						class="form-group"
						style="margin-top: 0.5rem; padding-left: 0.5rem; width: 50%;"
					>
						<span class="form-prepend text">DNI:</span>
						<input id="dni" type="text" class="form-input" />
					</div>
				</div>
				<div
					class="form-group"
					style="width: 95%; justify-content: space-between; margin-top: 1rem;"
				>
					<span
						class="form-prepend text center"
						style="width: 35%; border-top: 1px solid #212121;"
						>Firma Beneficiario o representante</span
					>
					<div style="width: 40%; padding-right: 5%;">
						<div
							class="form-group"
							style="margin-top: 0.5rem; padding-left: 0.5rem; width: 100%;"
						>
							<span class="form-prepend text">Aclaración:</span>
							<input
								id="clarification"
								type="text"
								class="form-input"
								style="border-bottom: 1px solid #212121;"
							/>
						</div>
						<div
							class="form-group"
							style="margin-top: 0.5rem; padding-left: 0.5rem; width: 100%;"
						>
							<span class="form-prepend text">DNI Firmante:</span>
							<input
								id="signer-dni"
								type="text"
								class="form-input"
								style="border-bottom: 1px solid #212121;"
							/>
						</div>
					</div>
				</div>
				<div class="form-group" style="margin-top: 1.25rem; width: 75%;">
					<span class="form-prepend text"
						>Lugar y Fecha de Consentimiento:</span
					>
					<input
						id="consent-place-date-"
						type="text"
						class="form-input"
						style="border-bottom: 1px solid #212121;"
					/>
				</div>
			</div>

			<footer style="margin-top: 3rem;">
				<div class="footer-line light" style="height: 1px;"></div>
				<p class="text" style="margin-top: 0.2rem">
					Subsidios por Discapacidad 2019
				</p>
			</footer>
		</main>

		<script src="../../app.js"></script>
	</body>
</html>
