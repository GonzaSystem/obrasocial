<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturacionElectronicaCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturacion_electronica_certificados', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('user_id');
			$table->string('path');
			$table->bigInteger('punto_venta');
			$table->bigInteger('tipo_comprobante');
			$table->bigInteger('concepto');
			$table->bigInteger('tipo_documento');
			$table->bigInteger('numero_documento');
			$table->string('moneda_id', 10);
			$table->bigInteger('moneda_cotizacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturacion_electronica_certificados');
    }
}
