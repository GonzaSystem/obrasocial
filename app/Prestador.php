<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestador extends Model
{
    protected $table = 'prestador';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function obrasocial()
    {
    	return $this->hasMany('App\ObraSocial', 'id', 'os_id');
    }

    // public function beneficiario()
    // {
    // 	return $this->hasMany('App\Beneficiario', 'prestador_id', 'id')->leftJoin('traditum', 'beneficiario_id', 'beneficiario.id')->select('beneficiario.*', 'traditum.codigo', 'traditum.mes', 'traditum.anio')->orderBy('nombre', 'desc');
    // }

    public function beneficiario()
    {

        return $this->hasMany('App\Beneficiario', 'prestador_id', 'id')->where(\DB::raw('DATE_FORMAT(CAST(created_at as DATE), "%Y-%m")'), '<=', \Auth::user()->anio.'-'.\Auth::user()->mes)->where(function($query){
			$query->where(\DB::raw('DATE_FORMAT(CAST(deleted_at as DATE), "%Y-%m")'), '>', \Auth::user()->anio.'-'.\Auth::user()->mes)
				->orWhereNull('deleted_at');
				
		})->where('activo', 1)
		->withTrashed()->orderBy('nombre', 'desc');

	}
	
	public function beneficiarioInactivo()
    {

        return $this->hasMany('App\Beneficiario', 'prestador_id', 'id')->where(\DB::raw('DATE_FORMAT(CAST(created_at as DATE), "%Y-%m")'), '<=', \Auth::user()->anio.'-'.\Auth::user()->mes)->where(function($query){
			$query->where(\DB::raw('DATE_FORMAT(CAST(deleted_at as DATE), "%Y-%m")'), '>', \Auth::user()->anio.'-'.\Auth::user()->mes)
				->orWhereNull('deleted_at');
				
		})->where('activo', 0)
		->withTrashed()->orderBy('nombre', 'desc');

    }

    public function prestacion()
    {
        return $this->hasMany('App\Prestacion', 'id', 'prestacion_id');
    }
}
