<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturacionElectronicaCertificado extends Model
{
    protected $table = 'facturacion_electronica_certificados';

    protected $fillable = [
        'user_id',
        'cert_path',
        'key_path',
        'punto_venta',
        'tipo_comprobante',
        'concepto',
        'tipo_documento',
        'numero_documento',
        'moneda_id',
        'moneda_cotizacion',
        'tipo_alicuota',
        'tipo_tributo',
        'tipo_opcion',
    ];
}
