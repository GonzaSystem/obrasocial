<?php

namespace App\Helpers;

class OSUtil{

	static public function cuenta_dias($mes, $anio, $sesiones, $tope_dias = null, $inasistencias = null)
    {
		if($tope_dias == null || $tope_dias == 0){
			$tope_dias = 999999;
		}
        $count=0;
        $dias_mes=cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
        $coincidencia = array();
		$fechas_inasistencia = array();
		$fechas_adicionales = array();
		foreach($sesiones as $sesion){
			$tiempo = $sesion->tiempo;
			$numero_dia = $sesion->dia;
			$horario = $sesion->hora; 
			for($i=1;$i<=$dias_mes && $count < $tope_dias;$i++){
                if(date('N',strtotime($anio.'-'.$mes.'-'.$i))==$numero_dia){
                    $hor=new \DateTime($horario);
                    $fin=$hor->add( new \DateInterval( 'PT' . ( (integer) $tiempo ) . 'M' ) );
                    $fecha_fin = $fin->format( 'H:i' );
					$count++;
					if($i < 10){
						$i = 0 .$i;
					}
                    $coincidencia[$i] = date($i.'/'.$mes.'/'.substr($anio, -2)). '/' . $horario.'/'.$fecha_fin;
                }
			} 
		}	
		return $coincidencia;
	}
	
	static public function cuenta_inasistencias($mes, $anio, $sesiones, $inasistencias = [])
    {
        $count=0;
        $dias_mes=cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
        $coincidencia = array();
		$fechas_inasistencia = array();
		foreach($inasistencias as $inasistencia){
			foreach($sesiones as $sesion){
				$tiempo = $sesion->tiempo;
				$numero_dia = $sesion->dia;
				$horario = $sesion->hora; 
				for($i=1;$i<=$dias_mes;$i++){
					if(date($i.'/'.$mes.'/'.substr($anio, -2)) == $inasistencia->rango_fechas){
						$hor=new \DateTime($horario);
						$fin=$hor->add( new \DateInterval( 'PT' . ( (integer) $tiempo ) . 'M' ) );
						$fecha_fin = $fin->format( 'H:i' );
						$count++;
						$coincidencia[$i] = date($i.'/'.$mes.'/'.substr($anio, -2)). '/' . $horario.'/'.$fecha_fin;
					}
				} 
			}	
		}
		return $coincidencia;
	}
	
	static public function cuenta_agregado($mes, $anio, $sesiones, $agregados = [])
    {
		$count=0;
        $dias_mes=cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
        $coincidencia = array();
		$fechas_agregado = array();
		foreach($agregados as $agregado){
			foreach($sesiones as $sesion){
				$tiempo = $sesion->tiempo;
				$numero_dia = $sesion->dia;
				$horario = $sesion->hora; 
				for($i=1;$i<=$dias_mes;$i++){
					if(date($i.'/'.$mes.'/'.substr($anio, -2)) == $agregado->rango_fechas){
						$hor=new \DateTime($horario);
						$fin=$hor->add( new \DateInterval( 'PT' . ( (integer) $tiempo ) . 'M' ) );
						$fecha_fin = $fin->format( 'H:i' );
						$count++;
						$coincidencia[$i] = date($i.'/'.$mes.'/'.substr($anio, -2)). '/' . $horario.'/'.$fecha_fin;
					}
				} 
			}	
		}
		return $coincidencia;
    }
}