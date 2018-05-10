<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('oportunity_id')->unsigned();
            $table->string('archivo');
            $table->string('nota');
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
	    $table->foreign('usu_alta_id')->references('id')->on('users');
            $table->foreign('oportunity_id')->references('id')->on('oportunities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files_customer');
    }
}
