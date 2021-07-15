<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCochesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero');
            $table->bigInteger('Agencia_id')->unsigned();
            $table->bigInteger('tipo_Coche_id')->unsigned();
            $table->foreign('Agencia_id')->references('id')->on('Agencias')->onDelete('cascade');
            $table->foreign('tipo_Coche_id')->references('id')->on('tipo_Coches')->onDelete('cascade');
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
        Schema::dropIfExists('coches');
    }
}
