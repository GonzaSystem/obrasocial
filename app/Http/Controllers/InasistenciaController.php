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

                        if($value < 10 && strlen($value) < 2){
                            $inasistencia->rango_fechas = '0'. $value . '/' . date('m/Y');
                        }else{
                            $inasistencia->rango_fechas = $value . '/' . date('m/Y');
                        }

                        if($request['agregarToForm'] == "Agregar"){
                            $inasistencia->tipo = 'Agregado';
                        }else{
                            $inasistencia->tipo = 'Inasistencia';
                        }
                        $inasistencia->save();

                        $inasistencias = Inasistencia::where('beneficiario_id', $request['id_beneficiario'])->get();
                    }
                        return [
                            'success' => true,
                            'message' => 'Inasistencias cargadas correctamente.',
                            'inasistencias' => $inasistencias
                        ];
                    break;
                
                case 'rango':
                    $inasistencia = new Inasistencia;
                    $inasistencia->beneficiario_id = $request['id_beneficiario'];
                    $inasistencia->rango_fechas = $request['fechas'];
                    $inasistencia->tipo = $request['agregarToForm'];
                    $inasistencia->save();
                    
                    $inasistencias = Inasistencia::where('beneficiario_id', $request['id_beneficiario'])->get();
                    return [
                        'success' => true,
                        'message' => 'Rango de inasistencias cargadas correctamente.',
                        'inasistencias' => $inasistencias
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
    public function show(Request $request)
    {
        $inasistencias = Inasistencia::where('beneficiario_id', $request['id'])->get();
        return [
            'success' => true,
            'inasistencias' => $inasistencias
        ];

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
    public function destroy(Request $request)
    {
        $inasistencia = Inasistencia::find($request['id']);
        if($inasistencia->delete()){
            $inasistencias = Inasistencia::where('beneficiario_id', $request['id_beneficiario'])->get();
            return [
                'success' => true,
                'message' => 'Inasistencia eliminada correctamente.',
                'inasistencias' => $inasistencias
            ];
        }else{
            return [
                'success' => false,
                'message' => 'Inasistencia eliminada correctamente.'
            ];
        }
    }
}
