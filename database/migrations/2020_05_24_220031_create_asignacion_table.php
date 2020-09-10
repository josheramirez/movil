<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('solicitud_id')->nullable();
            $table->unsignedBigInteger('movil_id')->nullable();
            $table->unsignedBigInteger('usuario_asignador_id')->nullable();

            $table->foreign('usuario_asignador_id')
                ->references('id')
                ->on('users');
            $table->foreign('movil_id')
                ->references('id')
                ->on('moviles');
            $table->foreign('solicitud_id')
                ->references('id')
                ->on('solicitudes');

            $table->softDeletes();
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
        Schema::dropIfExists('asignaciones');
    }
}
