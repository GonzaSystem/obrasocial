<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasocialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obrasocial', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 75);
            $table->string('cuit', 45);
            $table->string('telefono', 45);
            $table->string('ciudad', 65);
            $table->string('direccion', 75);
            $table->string('email', 45);
            $table->string('condicion_iva', 50);
            $table->decimal('valor_sesion', 10, 2);
            $table->decimal('valor_km', 10, 2);
            $table->decimal('valor_modulo', 10, 2);
            $table->string('valor_mes', 50);
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
        Schema::dropIfExists('obrasocial');
    }
}
