<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudMovilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_movil', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('solicitud_id')->nullable();
            $table->unsignedBigInteger('movil_id')->nullable();
            $table->unsignedBigInteger('administrador_id')->nullable();

            $table->foreign('solicitud_id')->references('id')->on('solicitudes');
            $table->foreign('movil_id')->references('id')->on('moviles');
            $table->foreign('administrador_id')->references('id')->on('users');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitud_movil');
    }
}
