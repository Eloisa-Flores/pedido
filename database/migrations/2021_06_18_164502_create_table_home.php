<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableHome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home', function (Blueprint $table) {
               $table->increments('id');
            $table->string('pedido');
            $table->string('codigo');
            $table->string('descripcion');
            $table->string('fabrica')->references("codigo")->on("empresas");
            $table->string('nota');
            $table->date('fecha_pedido');
            $table->date('fecha_requerida');
            $table->string('empaque');
            $table->integer('cantidad_original');
            $table->integer('cantidad_recibida');
            $table->integer('cantidad_pendiente');
            $table->string('dias')->default(0);
            $table->string('estado')->default('Solicitado');
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
        Schema::dropIfExists('home');
    }
}
