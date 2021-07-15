<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoCochesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_coches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo');
            $table->bigInteger('Agencia_id')->unsigned();
            $table->foreign('Agencia_id')->references('id')->on('Agencias');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_coches');
    }
}
