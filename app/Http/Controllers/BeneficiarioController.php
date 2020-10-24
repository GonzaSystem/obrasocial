<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Prestador;
use App\User;
use App\Beneficiario;
use App\ObraSocial;
use App\Sesion;
use App\Traditum;
use App\Helpers\OSUtil;
use Auth;

class BeneficiarioController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
	}


    public function index($prest_id, $os_id, $mes = null, $anio = null)
    {
        // Muestro beneficiarios
        if($mes == null){
            $mes = date('m');           
        }

        if($anio == null){
            $anio = date('Y');           
		}
		
    	// Declaro objeto de usuario
    	$user = \Auth::user()->id;

    	// Objeto Menu prestador
        $prestador_menu = \DB::select("SELECT obrasocial.nombre, obrasocial.id FROM obrasocial LEFT JOIN prestador on prestador.os_id = obrasocial.id WHERE prestador.user_id = " . $user . " GROUP BY obrasocial.id, obrasocial.nombre");

        // Objeto prestaciones
        $prestacion = Prestador::where('user_id', $user)
        ->where('os_id', $os_id)
        ->with('prestacion')
        ->get();

        //$beneficiario = Beneficiario::where('prestador_id', $prest_id)->with('prestador')->get();

        // Traigo beneficiarios segun prestador y obra social
        $beneficiarios = Prestador::where('user_id', $user)
         ->where('os_id', $os_id)
         ->with('prestacion', 'beneficiario.inasistencia', 'beneficiario.agregado', 'beneficiario.sesion')
         ->orderBy('id', 'desc')
		 ->get();
		 $fechas = array();
         $traditums = array();
         foreach($beneficiarios as $beneficiario){
            foreach($beneficiario->beneficiario as $k => $benef){
                $traditums[$benef->id] = Traditum::where('beneficiario_id', $benef->id)->where('mes', \Auth::user()->mes)->get()->toArray();
                if(empty($traditums[$benef->id])){
                    $traditums[$benef->id][0]['codigo'] = null;
                    $traditums[$benef->id][0]['id'] = null;
				}
				
				// Sesiones
				$inasistencias = $benef->inasistencia;
				$adicionales = $benef->agregado;
				$sesiones = $benef->sesion;
				$cant_solicitada = $benef->tope;
				$totalDias = count($sesiones);
				$fechas['total'][$benef->id] = OSUtil::cuenta_dias($mes, $anio, $sesiones, $cant_solicitada);
				$fechas['inasistencias'][$benef->id] = OSUtil::cuenta_inasistencias($mes, $anio, $sesiones, $inasistencias);
				$fechas['agregado'][$benef->id] = OSUtil::cuenta_agregado($mes, $anio, $sesiones, $adicionales);
				$fechas['total_agregado'][$benef->id] = count($benef->agregado);
            }
		 }
        // Sumario de fechas
		$cuenta = array();
		foreach ($fechas['total'] ?? [] as $key => $fecha) {
            $cuenta[$key] = 0;
			foreach($fecha as $k => $v){
				$cuenta[$key]++;
				$fecha_individual = explode('/', $v);
				foreach($fechas['inasistencias'][$key] as $inasistencia){
					$inasistencia_individual = explode('/', $inasistencia);	
					if($fecha_individual[0].'/'.$fecha_individual[1].'/'.$fecha_individual[2] == $inasistencia_individual[0].'/'.$inasistencia_individual[1].'/'.$inasistencia_individual[2]){
						$cuenta[$key]--;
					}
				}			
			}
			$fechas['tope'][$key] = $cuenta;
		}

    	// Objeto Obra Social
    	$obraSocial = ObraSocial::where('id', $os_id)->get();
		$data['beneficiarios'] = $beneficiarios;
		$data['obrasocial'] = $obraSocial;
		$data['prestador_menu'] = $prestador_menu;
		$data['prestacion'] = $prestacion;
        $data['traditums'] = $traditums;
        $data['fechas'] = $fechas;

    	return view('beneficiario',[
    		'data' => $data
    	]);
	}
	
	public function beneficiariosInactivos($user_id)
	{
		// Prestador con beneficiarios
		$beneficiarios = Prestador::with('beneficiarioInactivo', 'obrasocial', 'prestacion')
		->where('prestador.user_id', $user_id)->get();

		// Objeto Menu prestador
		$prestador_menu = \DB::select("SELECT obrasocial.nombre, obrasocial.id FROM obrasocial LEFT JOIN prestador on prestador.os_id = obrasocial.id WHERE prestador.user_id = " . $user_id . " GROUP BY obrasocial.id, obrasocial.nombre");

		return view('beneficiarios-inactivos', [
			'beneficiarios' => $beneficiarios,
			'prestador_menu' => $prestador_menu
		]);
	}

	public function inactiveStatus($id, $id_os, $status)
	{
		$obra_social = ObraSocial::where('id', $id_os)->first();
        $beneficiario = Beneficiario::where('id', $id)->first();
        $beneficiario->activo = $status;

        if($beneficiario->save()){
            return redirect()->route('beneficiarios.inactivos', ['prestador_id' => \Auth::user()->id, 'obrasocial_id' => $obra_social])
            ->with(['message' => 'El estado del beneficiario ha sido actualizado correctamente']);
        }
	}

    public function create(Request $request)
    {
        // Objeto de beneficiario
        $beneficiario = new Beneficiario;

        // Obtengo datos de inputs
        $obra_social = $request->input('obraSocial');
        $prestador = $request->input('prestacion');
        $nombre = $request->input('nombre');
        $correo = $request->input('correo');
        $telefono = $request->input('telefono');
        $direccion = $request->input('direccion');
        $localidad = $request->input('localidad');
        $direccion_prestacion = $request->input('direccionPrestacion');
        $localidad_prestacion = $request->input('localidadPrestacion');
        $dni = $request->input('dni');
        $cuit = $request->input('cuit');

        if(\Auth::user()->role == 'Traslado'){
            $km_ida = $request->input('kmIda');
            $km_vuelta = $request->input('kmVuelta');
            $viajes_ida = $request->input('viajesIda');
            $viajes_vuelta = $request->input('viajesVuelta');
            $dependencia = $request->input('dependencia');
        }

        $turno = $request->input('turno');
        $notas = $request->input('notas');
        $numero_afiliado = $request->input('numero_afiliado');
        $codigo_seguridad = $request->input('codigo_seguridad');
        $cantidad_solicitada = $request->input('cantidad_solicitada');

        // Asigno inputs a objeto beneficiario
        $beneficiario->prestador_id = $prestador;
        $beneficiario->sesion_id = 1;
        $beneficiario->nombre = $nombre;
        $beneficiario->email = $correo;
        $beneficiario->telefono = $telefono;
        $beneficiario->direccion = $direccion;
        $beneficiario->localidad = $localidad;
        $beneficiario->dni = $dni;
        $beneficiario->cuit = $cuit;
        $beneficiario->direccion_prestacion = $direccion_prestacion;
        $beneficiario->localidad_prestacion = $localidad_prestacion;

        if(\Auth::user()->role == 'Traslado'){
            $beneficiario->km_ida = $km_ida;
            $beneficiario->km_vuelta = $km_vuelta;
            $beneficiario->viajes_ida = $viajes_ida;
            $beneficiario->viajes_vuelta = $viajes_vuelta;
            $beneficiario->dependencia = $dependencia;
        }

        $beneficiario->turno = $turno;
        $beneficiario->notas = $notas;
        $beneficiario->numero_afiliado = $numero_afiliado;
        $beneficiario->codigo_seguridad = $codigo_seguridad;
        $beneficiario->cantidad_solicitada = $cantidad_solicitada;

		// Guardo en DB
		$beneficiario->save();
		\Session::flash('BeneficiarioNombre', $beneficiario->nombre);
		\Session::flash('ModificacionBeneficiario', $beneficiario->id);
        // Traditum
        $traditum = new Traditum;
        $traditum->beneficiario_id = $beneficiario['id'];
        $traditum->codigo = $request->input('codigo_traditum');   
        $traditum->mes = date('m');
        $traditum->anio = date('Y');
        $traditum->save(); 

        return redirect()->route('beneficiarios', ['prestador_id' => \Auth::user()->id, 'obrasocial_id' => $obra_social])
            ->with(['message' => 'Los datos de beneficiario han sido guardados correctamente']);
    }

    public function list(Request $request)
    {
        // Busco objeto segun ID
        $beneficiario = Beneficiario::where('id', '=', $request->id)->with('prestador')->get();

        // Obtengo prestacion
        $prestacion = Prestador::where('id', $beneficiario[0]->prestador->id)->with(['prestacion', 'obrasocial'])->get();

        // Traditum
        $traditum = Traditum::where('beneficiario_id', '=', $request->id)->get();
        
        return json_encode(['beneficiario' => $beneficiario, 'prestacion' => $prestacion[0]->prestacion[0]->nombre, 'traditum' => $traditum, 'prestacion_completa' => $prestacion]);
    }

    public function delete($os_id, $beneficiario_id)
    {
		// Borro beneficiario
		$beneficiario = Beneficiario::find($beneficiario_id);
		if($beneficiario->delete()){
			return redirect()->route('beneficiarios', ['prestador_id' => \Auth::user()->id, 'obrasocial_id' => $os_id])
			->with(['message' => 'El beneficiario ha sido eliminado correctamente']);
		}    
	}
	
	public function beneficiarioInactivoDelete($os_id, $beneficiario_id)
    {
		// Borro beneficiario
		$beneficiario = Beneficiario::find($beneficiario_id);
		if($beneficiario->delete()){
			return redirect()->route('beneficiarios.inactivos', ['prestador_id' => \Auth::user()->id, 'obrasocial_id' => $os_id])
			->with(['message' => 'El beneficiario ha sido eliminado correctamente']);
		}    
    }

    public function presupuesto($prestador_id, $beneficiario_id)
    {
        $prestador = Prestador::where('id', '=', $prestador_id)->with('user')->get();
        $beneficiario = Beneficiario::find($beneficiario_id);
        return view('forms.8_4', [
            'prestador' => $prestador,
            'beneficiario' => $beneficiario,
        ]);
    }

    public function update(Request $request)
    {
        // Objeto de beneficiario
        $beneficiario = Beneficiario::find($request->id);

        // Obtengo datos de inputs
        $obra_social = $request->input('editarObraSocial');
        $nombre = $request->input('editarNombre');
        $correo = $request->input('editarCorreo');
        $telefono = $request->input('editarTelefono');
        $direccion = $request->input('editarDireccion');
        $localidad = $request->input('editarLocalidad');
        $direccion_prestacion = $request->input('editarDireccionPrestacion');
        $localidad_prestacion = $request->input('editarLocalidadPrestacion');
        $dni = $request->input('editarDni');
        $cuit = $request->input('editarCuit');

        if(\Auth::user()->role == 'Traslado'){
            $km_ida = $request->input('editarKmIda');
            $km_vuelta = $request->input('editarKmVuelta');
            $viajes_ida = $request->input('editarViajesIda');
            $viajes_vuelta = $request->input('editarViajesVuelta');
            $dependencia = $request->input('editarDependencia');
        }

        $turno = $request->input('editarTurno');
        $notas = $request->input('editarNotas');
        $numero_afiliado = $request->input('editar_numero_afiliado');
        $codigo_seguridad = $request->input('editar_codigo_seguridad');
        $cantidad_solicitada = $request->input('editar_cantidad_solicitada');


        // Asigno inputs a objeto beneficiario
        $beneficiario->nombre = $nombre;
        $beneficiario->email = $correo;
        $beneficiario->telefono = $telefono;
        $beneficiario->direccion = $direccion;
        $beneficiario->localidad = $localidad;
        $beneficiario->dni = $dni;
        $beneficiario->cuit = $cuit;
        $beneficiario->direccion_prestacion = $direccion_prestacion;
        $beneficiario->localidad_prestacion = $localidad_prestacion;

        if(\Auth::user()->role == 'Traslado'){
            $beneficiario->km_ida = $km_ida;
            $beneficiario->km_vuelta = $km_vuelta;
            $beneficiario->viajes_ida = $viajes_ida;
            $beneficiario->viajes_vuelta = $viajes_vuelta;
            $beneficiario->dependencia = $dependencia;
        }

        $beneficiario->turno = $turno;
        $beneficiario->notas = $notas;
        $beneficiario->numero_afiliado = $numero_afiliado;
        $beneficiario->codigo_seguridad = $codigo_seguridad;
        $beneficiario->cantidad_solicitada = $cantidad_solicitada;

        // Guardo en DB
		$beneficiario->save();
		\Session::flash('BeneficiarioNombre', $beneficiario->nombre);
		\Session::flash('ModificacionBeneficiario', $beneficiario->id);
        // Traditum
        $traditum = Traditum::where('beneficiario_id', $request->id)->first();
        if($traditum == null){
            $traditum = new Traditum;
            $traditum->beneficiario_id = $request->id;
            $traditum->codigo = $request->input('editar_codigo_traditum');   
            $traditum->mes = date('m');
            $traditum->anio = date('Y');
			$traditum->save();
		}  
        // }else{
        //     $traditum->codigo = $request->input('editar_codigo_traditum');   
        //     $traditum->mes = date('m');
        //     $traditum->anio = date('Y');
        //     $traditum->save();
        // }
        return redirect()->route('beneficiarios', ['prestador_id' => \Auth::user()->id, 'obrasocial_id' => $obra_social])
            ->with(['message' => 'Los datos de beneficiario han sido actualizados correctamente']);
    }

    public function formulario($bene_id, $prestador_id, $planilla, $mes = null, $anio = null)
    {
        if( $planilla == 1 ){
            $view = 'forms.rehabilitacion';
        }elseif( $planilla == 2 ){
            $view = 'forms.integracion';
        }elseif( $planilla == 3){
            $view = 'forms.traslado';
        }

        $beneficiario_id = $bene_id;
        if($mes == null){
            $mes = date('m');           
        }

        if($anio == null){
            $anio = date('Y');           
        }

        // $beneficiario = Beneficiario::where('id', $beneficiario_id)->with('prestador')->get();
        // $prestador = Prestador::where('id', $prestador_id)->with('prestacion')->get();
        // $sesiones = Sesion::where('beneficiario_id', $beneficiario_id)->get();
        // $fechas = array();
        // $fecha_fin = array();
        // foreach ($sesiones as $key => $sesion) {
        //     $cant_solicitada = $beneficiario[0]->tope;
        //     $totalDias = count($sesiones);
        //     if($cant_solicitada == null){
        //         $avgSesion = 99999;
        //     }else{
        //         $avgSesion = $cant_solicitada / $totalDias; 
        //     }


        //     //Ver de pasar el horario a la funcion
        //      $fechas[] = $this->cuenta_dias($mes, $anio, $sesion['dia'], $sesion['hora'], $avgSesion, $sesion['tiempo']);
        // }


		
		// Fechas V2
		$beneficiario = Beneficiario::where('id', $beneficiario_id)->with(['prestador', 'sesion', 'inasistencia'])->get();
		$prestador = Prestador::where('id', $prestador_id)->with('prestacion')->get();

		$fechas = array();
		foreach ($beneficiario as $key => $benef) {
			// Sesiones
			$inasistencias = $benef->inasistencia;
			$adicionales = $benef->agregado;
			$sesiones = $benef->sesion;
			$cant_solicitada = $benef->tope;
			$totalDias = count($sesiones);
			$fechas['total'][$benef->id] = OSUtil::cuenta_dias($mes, $anio, $sesiones, $cant_solicitada, $inasistencias);
			$fechas['inasistencias'][$benef->id] = OSUtil::cuenta_inasistencias($mes, $anio, $sesiones, $inasistencias);
			$fechas['agregado'][$benef->id] = OSUtil::cuenta_agregado($mes, $anio, $sesiones, $adicionales);
			$fechas['total_agregado'][$benef->id] = count($benef->agregado);
		}
        // Sumario de fechas
		$cuenta = array();
		$fechasParaBorrar = array();
		foreach ($fechas['total'] ?? [] as $key => $fecha) {
            $cuenta[$key] = 0;
			foreach($fecha as $k => $v){
				$cuenta[$key]++;
				$fecha_individual = explode('/', $v);
				foreach($fechas['inasistencias'][$key] as $inasistencia){
					$inasistencia_individual = explode('/', $inasistencia);	
					if($fecha_individual[0].'/'.$fecha_individual[1].'/'.$fecha_individual[2] == $inasistencia_individual[0].'/'.$inasistencia_individual[1].'/'.$inasistencia_individual[2]){
						$cuenta[$key]--;
						$fechasParaBorrar[$k] = $key; 
					}
				}	
				foreach ($fechas['agregado'] as $keyAgregado => $fechaAgregado) {
					foreach($fechaAgregado as $diaAgregado => $fechaAgr){
						$fechas['total'][$keyAgregado][$diaAgregado] = $fechaAgr;
					}
				}		
			}
			$fechas['tope'][$key] = $cuenta;
		}
		foreach ($fechasParaBorrar as $ind => $benefId) {
			unset($fechas['total'][$benefId][$ind]);
			ksort($fechas['total'][$benefId]);
		}
		ksort($fechas['total'][$beneficiario[0]->id]);
        // $merged = array_merge(...$fechas);
		// sort($merged, SORT_NUMERIC);
		// dd($merged);
		// Traigo mes actual
        $mes = date('m');
            switch ($mes){
        case '1':
            $mes = 'Enero';
            break;
        case '2':
            $mes = 'Febrero';
            break;
        case '3':
            $mes = 'Marzo';
            break;
        case '4':
            $mes = 'Abril';
            break;
        case '5':
            $mes = 'Mayo';
            break;
        case '6':
            $mes = 'Junio';
            break;
        case '7':
            $mes = 'Julio';
            break;
        case '8':
            $mes = 'Agosto';
            break;
        case '9':
            $mes = 'Septiembre';
            break;
        case '10':
            $mes = 'Octubre';
            break;
        case '11':
            $mes = 'Noviembre';
            break;
        case '12':
            $mes = 'Diciembre';
            break;
    }

        return view($view, [
            'fechas' => $fechas,
            'prestador' => $prestador,
            'beneficiario' => $beneficiario,
            'mes' => $mes,
        ]);
    }

    public function status($id, $id_os, $status){
        $obra_social = ObraSocial::where('id', $id_os)->first();
        $beneficiario = Beneficiario::where('id', $id)->first();
        $beneficiario->activo = $status;

        if($beneficiario->save()){
            return redirect()->route('beneficiarios', ['prestador_id' => \Auth::user()->id, 'obrasocial_id' => $obra_social])
            ->with(['message' => 'El estado del beneficiario ha sido actualizado correctamente']);
        }
    }

    public function traditum(Request $request)
    {
        $traditum = Traditum::where('id', $request['traditum'])->first();
        if($traditum){
            $traditum->codigo = $request['valor'];
            $traditum->save();
        }else{
            $traditum = new Traditum;
            $traditum->codigo = $request['valor'];
            $traditum->beneficiario_id = $request['beneficiario'];
            $traditum->mes = date('m');
            $traditum->anio = date('Y');
            $traditum->save();
        }
    }

    public function tope(Request $request)
    {
        $beneficiario = Beneficiario::where('id', $request['id'])->first();
        $beneficiario->tope = $request['tope'];
        if($beneficiario->save()){
            return [
                'success' => true,
                'message' => 'Tope cargado correctamente.'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'El tope no ha podido ser cargado. Por favor intente nuevamente.'
            ];
        }
	}

	
	public function planillaFacturacion($prestador_id, $os, $mes, $anio){
		$user = Auth::user();
		$prestador = Prestador::select('id', 'prestacion_id')->with(['prestacion', 'beneficiario'])
		->where('os_id', $os)
		->where('user_id', $user->id)->get();

		// Agrupando beneficiarios
		$beneficiarios = array();
		foreach($prestador as $k => $v){
			$codigo_modulo = $v->prestacion[0]->codigo_modulo;
			foreach($v->beneficiario as $k2 => $v2){
				$v2->codigo_modulo = $codigo_modulo;
				$v2->traditum = Traditum::select('codigo')->where('beneficiario_id', $v2->id)->where('mes', $mes)->where('anio', $anio)->first();		
				$beneficiarios[] = $v2;
			}
		}

		// Paginando de a 17
		$grupo = 0;
		$indice = 0;
		$beneficiariosAgrupados = array();
		$sortBenefs = usort($beneficiarios, function($a, $b){
			return strcmp($a->nombre, $b->nombre);
		});
		foreach($beneficiarios as $benef){	
			if($indice > 16){
				$grupo++;
				$indice = 0;
			}
			$beneficiariosAgrupados[$grupo][] = $benef;
			$indice++;
		}
		return view('beneficiarios-facturacion', ['informacion' => $beneficiariosAgrupados]);
	}
}
