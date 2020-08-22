<?php

namespace App\Http\Controllers;

use App\Inasistencia;
use App\Beneficiario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InasistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try{
            switch ($request['cantidad']) {
                case 'individual':
                    foreach ($request['fechas'] as $key => $value) {
                        $inasistencia = new Inasistencia;
                        $inasistencia->beneficiario_id = $request['id_beneficiario'];
                        $inasistencia->rango_fechas = $value . '-' . $value;
                        $inasistencia->save();
                    }
                        return [
                            'success' => true,
                            'message' => 'Inasistencias cargadas correctamente.'
                        ];
                    break;
                
                case 'rango':
                    $inasistencia = new Inasistencia;
                    $inasistencia->beneficiario_id = $request['id_beneficiario'];
                    $inasistencia->rango_fechas = $request['fechas'];
                    $inasistencia->save();

                    return [
                        'success' => true,
                        'message' => 'Rango de inasistencias cargadas correctamente.'
                    ];
                    break;        
            }

        }catch(Exception $e){
            return [
                'success' => false,
                'message' => 'Las inasistencias no han podido ser cargadas. Por favor intente nuevamente'
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inasistencia  $inasistencia
     * @return \Illuminate\Http\Response
     */
    public function show(Inasistencia $inasistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inasistencia  $inasistencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Inasistencia $inasistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inasistencia  $inasistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inasistencia $inasistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inasistencia  $inasistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inasistencia $inasistencia)
    {
        //
    }
}
