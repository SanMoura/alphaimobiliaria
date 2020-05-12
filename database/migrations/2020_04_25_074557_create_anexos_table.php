<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnexosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anexos', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('log_proposta_id')->unsigned();
            $table->foreign('log_proposta_id')->references('id')->on('log_proposta');


            $table->bigInteger('proposta_id')->unsigned();
            $table->foreign('proposta_id')->references('id')->on('proposta');

            $table->string('nome');
            $table->string('nomeOriginal');

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
        Schema::dropIfExists('anexos');
    }
}
