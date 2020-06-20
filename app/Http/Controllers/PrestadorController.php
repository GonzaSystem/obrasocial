<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\ObraSocial;
use App\Prestador;
use Illuminate\Support\Facades\DB;

class PrestadorController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function data()
    {
    	$userId = \Auth::user()->id;

    	// Obtengo datos de prestador si existen
        $prestador = Prestador::where('user_id', $userId)->with('user', 'obrasocial', 'prestacion')->get();

        //Prestador_menu 
        $prestador_menu = \DB::select("SELECT obrasocial.nombre, obrasocial.id FROM obrasocial LEFT JOIN prestador on prestador.os_id = obrasocial.id WHERE prestador.user_id = " . $userId . " GROUP BY obrasocial.id, obrasocial.nombre");

    	$os = DB::table('obrasocial')->select('id', 'nombre')->get();

    		// $os = DB::select(DB::raw('SELECT os.id, os.nombre FROM `obrasocial` os LEFT JOIN prestador pr on os.id = pr.os_id WHERE os.id NOT IN (SELECT pr.os_id from prestador pr WHERE pr.user_id = '.$userId.')'));					

    	// Devuelvo vista con parametros
        return view('datos-prestador', [
        	"prestador" => $prestador,
        	"obrasocial" => $os,
            "prestador_menu" => $prestador_menu
        ]);
    }

    public function create(Request $request)
    {	
        // Creo prestador

    	// Valido formulario
    	$validar = $this->validate($request, [
    		'numeroPrestador' => ['integer', 'required']
    	]);

    	// Declaro objetos
    	$prestador = new Prestador;
    	$usuario = \Auth::user()->id;
    	// Obtengo datos de formulario
    	$os_id = $request->input('obraSocial');
    	$numero_prestador = $request->input('numeroPrestador');
        $prestacion_id = $request->input('profesion');
        $valor_default = $request->input('utiliza_valor_profesion');

        if($valor_default == 'T'){
            $valor = 0;
        }else{
            $valor = $request->input('valor_profesion');
        }

    	// Asigno datos al objeto prestador
    	$prestador->user_id = $usuario;
    	$prestador->os_id = $os_id;
    	$prestador->numero_prestador = $numero_prestador;
        $prestador->prestacion_id = $prestacion_id;
        $prestador->valor_default = $valor_default;
        $prestador->valor_prestacion = $valor;

    	// Guardo en DB 		
   		$prestador->save();

   		return redirect()->route('datos-prestador')->with(['message' => 'Los datos de prestador han sido guardados correctamente']);
    }

    public function list(Request $request)
    {
    	// Busco objeto segun ID
    	$prestador = Prestador::find($request->id);
    	return $prestador;
    }

    public function update(Request $request)
    {
        // Actualizo prestador 
        
    	// Creo objeto para editar
    	$prestador = Prestador::find($request->id);

    	// Datos de input
    	$numero_prestador = $request->input('editarNumeroPrestador');

    	// Asigno datos a objeto
    	$prestador->numero_prestador = $numero_prestador;

    	// Guardo en DB
    	$prestador->save();

    	return redirect()->route('datos-prestador')->with(['message' => 'Los datos de prestador han sido editados correctamente']);
    }
}
