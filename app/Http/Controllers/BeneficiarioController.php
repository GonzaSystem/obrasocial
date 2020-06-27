<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Prestador;
use App\User;
use App\Beneficiario;
use App\ObraSocial;

class BeneficiarioController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($prest_id, $os_id)
    {
        // Muestro beneficiarios
        
    	// Declaro objeto de usuario
    	$user = \Auth::user()->id;

    	// Objeto Menu prestador
        $prestador_menu = \DB::select("SELECT obrasocial.nombre, obrasocial.id FROM obrasocial LEFT JOIN prestador on prestador.os_id = obrasocial.id WHERE prestador.user_id = " . $user . " GROUP BY obrasocial.id, obrasocial.nombre");

        // Objeto prestaciones
        $prestacion = Prestador::where('user_id', $user)
        ->where('os_id', $os_id)
        ->get();

        //$beneficiario = Beneficiario::where('prestador_id', $prest_id)->with('prestador')->get();

        // Traigo beneficiarios segun prestador y obra social
        $beneficiario = Prestador::where('user_id', $user)
         ->where('os_id', $os_id)
         ->with('beneficiario')
         ->get();

    	// Objeto Obra Social
    	$obraSocial = ObraSocial::where('id', $os_id)->get();

    	return view('beneficiario',[
    		"beneficiarios" => $beneficiario,
    		"obrasocial" => $obraSocial,
            "prestador_menu" => $prestador_menu,
            "prestacion" => $prestacion,
    	]);
    }

    public function create(Request $request)
    {
    	// Objeto de beneficiario
    	$beneficiario = new Beneficiario;

    	// Obtengo datos de inputs
        $obra_social = $request->input('obraSocial');
        $prestador = $request->input('prestacion');
    	$nombre = $request->input('nombre');
    	$apellido = $request->input('apellido');
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

    	// Asigno inputs a objeto beneficiario
    	$beneficiario->prestador_id = $prestador;
        $beneficiario->sesion_id = 1;
        $beneficiario->nombre = $nombre;
        $beneficiario->apellido = $apellido;
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

    	// Guardo en DB        
        $beneficiario->save();

        return redirect()->route('beneficiarios', ['prestador_id' => \Auth::user()->id, 'obrasocial_id' => $obra_social])
            ->with(['message' => 'Los datos de beneficiario han sido guardados correctamente']);
    }

    public function list(Request $request)
    {
        // Busco objeto segun ID
        $beneficiario = Beneficiario::where('id', '=', $request->id)->with('prestador')->get();
        return $beneficiario;
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
        $apellido = $request->input('editarApellido');
        $correo = $request->input('editarCorreo');
        $telefono = $request->input('editarTelefono');
        $direccion = $request->input('editarDireccion');
        $localidad = $request->input('editarLocalidad');
        $direccion_prestacion = $request->input('editarDireccionPrestacion');
        $localidad_prestacion = $request->input('editarLocalidadPrestacion');
        $dni = $request->input('editarDni');
        $cuit = $request->input('editarCuit');
        $km_ida = $request->input('editarKmIda');
        $km_vuelta = $request->input('editarKmVuelta');
        $viajes_ida = $request->input('editarViajesIda');
        $viajes_vuelta = $request->input('editarViajesVuelta');
        $turno = $request->input('editarTurno');
        $dependencia = $request->input('editarDependencia');
        $notas = $request->input('editarNotas');

        // Asigno inputs a objeto beneficiario
        $beneficiario->nombre = $nombre;
        $beneficiario->apellido = $apellido;
        $beneficiario->email = $correo;
        $beneficiario->telefono = $telefono;
        $beneficiario->direccion = $direccion;
        $beneficiario->localidad = $localidad;
        $beneficiario->dni = $dni;
        $beneficiario->cuit = $cuit;
        $beneficiario->direccion_prestacion = $direccion_prestacion;
        $beneficiario->localidad_prestacion = $localidad_prestacion;
        $beneficiario->km_ida = $km_ida;
        $beneficiario->km_vuelta = $km_vuelta;
        $beneficiario->viajes_ida = $viajes_ida;
        $beneficiario->viajes_vuelta = $viajes_vuelta;
        $beneficiario->turno = $turno;
        $beneficiario->dependencia = $dependencia;
        $beneficiario->notas = $notas;

        // Guardo en DB        
        $beneficiario->save();

        return redirect()->route('beneficiarios', ['prestador_id' => \Auth::user()->id, 'obrasocial_id' => $obra_social])
            ->with(['message' => 'Los datos de beneficiario han sido actualizados correctamente']);
    }
}
