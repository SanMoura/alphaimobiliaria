<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcompClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acomp_cliente', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('cliente');

            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status');

            $table->string('observacoes')->nullable();

            $table->boolean('sn_ativo')->default(true);

            

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
        Schema::dropIfExists('acomp_cliente');
    }
}
