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

    public function beneficiario()
    {
    	return $this->hasMany('App\Beneficiario', 'prestador_id', 'id')->orderBy('beneficiario.nombre');
    }

    public function prestacion()
    {
        return $this->hasMany('App\Prestacion', 'id', 'prestacion_id');
    }
}
