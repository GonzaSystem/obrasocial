<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturacionElectronicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturacion_electronica', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('prestador_id');
			$table->bigInteger('os_id');
			$table->float('importe_total', 8, 2);
			$table->float('importe_neto_no_gravado', 8, 2);
			$table->float('importe_neto_gravado', 8, 2);
			$table->float('importe_exento_iva', 8, 2);
			$table->float('importe_total_iva', 8, 2);
			$table->float('importe_total_tributos', 8, 2);
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
        Schema::dropIfExists('facturacion_electronica');
    }
}
