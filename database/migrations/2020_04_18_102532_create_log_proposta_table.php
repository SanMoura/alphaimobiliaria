<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPropostaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_proposta', function (Blueprint $table) {
            $table->id();
            $table->timestamp('dt_atendimento');

            $table->string('imovel')->nullable();
            $table->string('valorImovel')->nullable();
            $table->string('user_id_adicional')->nullable();
            
            $table->longText('observacoes')->nullable();

            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status');

            $table->bigInteger('proposta_id')->unsigned();
            $table->foreign('proposta_id')->references('id')->on('proposta');
            
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
        Schema::dropIfExists('log_proposta');
    }
}
