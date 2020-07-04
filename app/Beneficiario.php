<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
	protected $table = 'beneficiario';
	
    public function prestador()
    {
    	return $this->belongsTo('App\Prestador', 'prestador_id', 'id');
    }

    public function sesion()
    {
    	return $this->hasMany('\App\Sesion', 'id', 'beneficiario_id');
    }
}
