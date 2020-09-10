<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSolicitudMovilIdToSolicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud', function (Blueprint $table) {
            $table->unsignedBigInteger('solicitud_movil_id')->nullable();
            $table->foreign('solicitud_movil_id')->references('id')->on('solicitud_movil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud', function (Blueprint $table) {
            //
        });
    }
}
