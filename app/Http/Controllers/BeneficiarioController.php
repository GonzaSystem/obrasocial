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

        $beneficiario = Beneficiario::where('prestador_id', $prest_id)->get();

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
    	$dni = $request->input('dni');
    	$cuit = $request->input('cuit');
    	$prestacion = $request->input('prestacion');
        $direccion_prestacion = $request->input('direccionPrestacion');
    	$km_ida = $request->input('kmIda');
    	$km_vuelta = $request->input('kmVuelta');
    	$viajes_ida = $request->input('viajesIda');
    	$viajes_vuelta = $request->input('viajesVuelta');
    	$turno = $request->input('turno');
    	$dependencia = $request->input('dependencia');
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
            ->with(['message' => 'Los datos de beneficiario han sido guardados correctamente']);
    }
}
