<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('origen')->nullable();
            $table->string('destino')->nullable();
            $table->integer('pasajeros')->nullable();
            $table->date('fecha_agendada')->nullable();
            $table->string('hora_salida')->nullable();
            $table->string('hora_llegada')->nullable();
            $table->unsignedBigInteger('usuario_agendador_id')->nullable();

            $table->foreign('usuario_agendador_id')
                ->references('id')
                ->on('users');

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
        Schema::dropIfExists('solicitudes');
    }
}
