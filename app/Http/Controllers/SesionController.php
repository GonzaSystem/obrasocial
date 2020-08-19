<?php

namespace App\Http\Controllers;

use App\Sesion;
use App\Beneficiario;
use Illuminate\Http\Request;

class SesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->id;
        $beneficiario = Beneficiario::where('id', $id)->first();
        $sesiones = Sesion::where('beneficiario_id', $id)->with('beneficiario')->get();
        return [
            'sesiones' => $sesiones,
            'beneficiario' => $beneficiario
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $beneficiario_id = $request->beneficiario_id;
        $beneficiario = Beneficiario::where('id', $beneficiario_id)->first();
        $sesiones = Sesion::where('beneficiario_id', $beneficiario_id)->get();
        // if($beneficiario->cantidad_solicitada == 4 && count($sesiones) < 1 || $beneficiario->cantidad_solicitada == 8 && count($sesiones) < 2 || $beneficiario->cantidad_solicitada == 12 && count($sesiones) < 4){

        if(isset($request['tope']) && $request['tope'] > 0){
            $beneficiario->tope = $request['tope'];
            $beneficiario->save();
        }

        $validate = \Validator::make($request->all(), [
            'dia' => 'required',
            'hora' => 'required',
            'tiempo' => 'required'
        ]);

        if($validate->fails()){
            return [
                'error' => 'Los campos día, hora y tiempo son obligatorios. Por favor completelos e intente nuevamente.'
            ];
        }

        $sesion = new Sesion;
        $obra_social = $request->obrasocial_id;
        $dia = $request->dia;
        $hora = $request->hora;
        $tiempo = $request->tiempo;
        $sesion->beneficiario_id = $beneficiario_id;
        $sesion->dia = $dia;
        $sesion->hora = $hora;
        $sesion->tiempo = $tiempo; 
        if($sesion->save()){
          $sesiones = Sesion::where('beneficiario_id', $beneficiario_id)->get();
          return json_encode(['error' => false,
                              'sesiones' => $sesiones]);                   
        }

        // }else{
        //     return json_encode(['error' => 'Hay un error con la cantidad solicitada y los días a cargar. Por favor verifiquelos e intente nuevamente.',
        //                         'sesiones' => $sesiones]);
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function show(Sesion $sesion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function edit(Sesion $sesion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sesion $sesion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $sesion = Sesion::find($request->id);
        $sesion->delete();

        $beneficiario_id = $request->beneficiario_id;
        $sesiones = Sesion::where('beneficiario_id', $beneficiario_id)->get();
        return $sesiones;
    }
}
