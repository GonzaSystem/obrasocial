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

        $sesiones = Sesion::where('beneficiario_id', $id)->get();
        return $sesiones;
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
        $sesion = new Sesion;
        $obra_social = $request->input('obrasocial_id');

        $beneficiario_id = $request->input('beneficiario_id');
        $dia = $request->input('dia');
        $hora = $request->input('hora');
        $tiempo = $request->input('tiempo');

        $sesion->beneficiario_id = $beneficiario_id;
        $sesion->dia = $dia;
        $sesion->hora = $hora;
        $sesion->tiempo = $tiempo;

        $sesion->save();

        $beneficiario = Beneficiario::find($beneficiario_id);

        return redirect()->route('beneficiarios', ['prestador_id' => \Auth::user()->id, 'obrasocial_id' => $obra_social])
            ->with(['message' => 'El horario de '.$beneficiario->nombre.' ha sido guardado correctamente']);
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
    public function destroy(Sesion $sesion)
    {
        //
    }
}
