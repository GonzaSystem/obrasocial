<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request)
    {
        $user = \Auth::user();
        $id = $user->id;

        // Valido campos
        $validate = $this->validate($request, [
        	'direccion' => ['max:100'],
        	'telefono' => ['max:45'],
        	'cuit' => ['max:50'],
        ]);

        // Datos de inputs
        $direccion = $request->input('direccion');
        $provincia = $request->input('provincia');
        $telefono = $request->input('telefono');
        $cuit = $request->input('cuit');
        $condicion_iva = $request->input('condicionIva');
        $condicion_iibb = $request->input('condicionIibb');
        $iibb = $request->input('iibb');
        $entidadBancaria = $request->input('entidadBancaria');
        $cbu = $request->input('cbu');
        $ordenCheque = $request->input('ordenCheque');
        $lugarPago = $request->input('lugarPago');
        $empSeguros = $request->input('empSeguros');
        $poliza = $request->input('polSeguros');


        // Asigno valores al objeto usuario
        $user->direccion = $direccion;
        $user->provincia = $provincia;
        $user->telefono = $telefono;
        $user->cuit = $cuit;
        $user->condicion_iva = $condicion_iva;
        $user->condicion_iibb = $condicion_iibb;
        $user->iibb = $iibb;
        $user->entidad_bancaria = $entidadBancaria;
        $user->cbu = $cbu;
        $user->orden_cheque = $ordenCheque;
        $user->lugar_pago = $lugarPago;
        $user->emp_seguros = $empSeguros;
        $user->poliza = $poliza;

        // Query            
        $user->update();

        return redirect()->route('home')->with(['message' => 'Usuario actualizado correctamente']);


       
    }
}
