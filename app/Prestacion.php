<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestacion extends Model
{
    protected $table = 'prestacion';

    public function obrasocial()
    {
    	return $this->belongsTo('App\ObraSocial', 'os_id', 'id');
    }
}
