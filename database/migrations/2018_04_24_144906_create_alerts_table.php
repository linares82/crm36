<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('oportunity_id')->unsigned();
            $table->string('message');
            $table->string('detail')->nullable();
            $table->dateTime('date_send');
            $table->boolean('mail_bnd');
            $table->integer('day_before_sent')->default(0);
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
        Schema::dropIfExists('avisos');
    }
}
