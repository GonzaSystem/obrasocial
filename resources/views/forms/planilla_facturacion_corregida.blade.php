<!DOCTYPE html>
<!-- saved from url=(0038)http://localhost/adrian/formulario.php -->
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Planilla facturacion</title>
<link rel="stylesheet" href="{{asset('css/estilosi_corregida.css')}}" media="print">
<style type="text/css">
	body {
		
		background: #e3e6db;
		margin: 0px;
		padding: 0px;
	}
	input{ background: none;border: none;}
	#cabecera {
		position: absolute;
		margin-top: 123px;
		text-align: left;
	}
	#cabecera * {
		position: relative;
	}
	#contenedor {text-align: center;
		width:1350px;
		height:928px;
		margin:auto;
		background: url('{{asset("img/imagen_corregida.jpg")}}') #e3e6db no-repeat;


	}
	#transporte {
		left: 143px;
		margin-top:30px;
		display: block;
		width:1200px;
	}
	#transporte1 {width: 393px; float: left}
	#periodo {
		margin-top: 16px;
	}
	#codigo { margin-left: 178px;
		width: 550px;
	}
	.clear {
		clear: both;
	}
	#periodo{margin-left: 127px;}
	#periodo1{width: 35px;}
	#periodo2{width: 45px;}
	#periodo2{margin-left: 10px;}
	#datos { position: absolute;
		margin-top: 252px;
		margin-left: 18px;
		width:1095px;
		text-align: left;
	}
	.fila {
		width:1340px;
	}

	.fila input { height: 17.19px; margin-top: 2px;
		border-bottom: 1px solid black;
	}
	.f19 {border-bottom:none !important;}
.c3,.c4,.c5,.c6,.c7,.c9{ text-align: center; }
	.c0{width: 296px}
	.c1{width: 177px;margin-left: 10px;}
	.c2{width: 179px;margin-left: 1px;}
	.c3{width: 65px;margin-left: 2px;}
	.c4{width: 65px}
	.c5{width: 65px}
	.c6{width: 95px;margin-left:0px;}
	.c7{width: 96px}
	.c8{width: 96px;margin-left: 1px;text-align: center;}
	.c9{width: 96px}
	#importe1 {margin-left:1120px;width: 87px;margin-top: 8px}
	#importe input {text-align: center;}
	#firma {margin-left:925px;margin-top: 77px}
	#firma input {text-align: center}
	#firma1{width: 375px; }
	#boton_im {
	position:absolute;
	margin-top:20px;
	margin-left: 710px;
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
	<div id="transporte"><input type="text" name="transporte" id="transporte1">
		<input type="text" name="codigo" id="codigo">
	</div>
	<div class="clear"></div>
	<div id="periodo"><input type="text" name="periodo" id="periodo1"><input type="text" name="periodo" id="periodo2"></div>
</div>
<div id="datos">
			<div class="fila f0">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f1">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f2">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f3">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f4">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f5">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f6">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f7">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f8">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f9">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f10">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f11">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f12">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f13">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f14">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f15">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f16">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f17">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f18">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f18">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
					<div class="fila f18">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>
			<div class="fila f19">
							<input type="text" name="text0" class="c0">
							<input type="text" name="text1" class="c1">
							<input type="text" name="text2" class="c2">
							<input type="text" name="text3" class="c3">
							<input type="text" name="text4" class="c4">
							<input type="text" name="text5" class="c5">
							<input type="text" name="text6" class="c6">
							<input type="text" name="text7" class="c7">
							<input type="text" name="text8" class="c8">
							<input type="text" name="text9" class="c9">
					</div>

		<div id="importe"><input type="text" name="importe" id="importe1">
		<div id="firma"><input type="text" name="firma" id="firma1">
	</div>
</div>

</div>

</div>

</body>
</html>