<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiario', function (Blueprint $table) {
            $table->id();
            $table->integer('prestador_id');
            $table->integer('sesion_id');
            $table->string('nombre', 75);
            $table->string('apellido', 75);
            $table->string('email', 45);
            $table->string('telefono', 75);
            $table->string('direccion', 75);
            $table->string('localidad', 75);
            $table->integer('cp');
            $table->string('dni', 15);
            $table->string('cuit', 45);
            $table->string('prestacion', 50);
            $table->string('direccion_prestacion', 50);
            $table->integer('km_ida');
            $table->integer('km_vuelta');
            $table->integer('viajes_ida');
            $table->integer('viajes_vuelta');
            $table->string('turno', 20);
            $table->string('dependencia', 50);
            $table->string('notas');
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
        Schema::dropIfExists('beneficiario');
    }
}
