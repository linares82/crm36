<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razon')->nullable();
            $table->string('nombre1');
            $table->string('nombre2')->nullable();
            $table->string('ape_paterno');
            $table->string('ape_materno')->nullable();
            $table->string('calle');
            $table->string('numero_int')->nullable();
            $table->string('numero_ext')->nullable();
            $table->string('colonia');
            $table->string('ciudad')->nullable();
            $table->integer('estado_id')->unsigned();
            $table->integer('municipio_id')->unsigned();
            $table->string('cp');
            $table->string('celular')->nullable();
            $table->boolean('celular_confirmar')->default(0);
            $table->integer('cuenta_sms')->default(0);
            $table->string('fijo')->nullable();
            $table->string('email')->nullable();
            $table->integer('cuenta_email')->default(0);
            $table->boolean('email_confirmar')->default(0);
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
			$table->foreign('usu_alta_id')->references('id')->on('users');
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->foreign('estado_id')->references('id')->on('estados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
