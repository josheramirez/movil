<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstadoToSolicitudMovil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_movil', function (Blueprint $table) {
            $table->unsignedBigInteger('estado_movil_id')->nullable()->after('movil_id');
            $table->foreign('estado_movil_id')
                ->references('id')
                ->on('estado_movil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud_movil', function (Blueprint $table) {
            $table->dropColumn('estado_movil_id');
        });
    }
}
