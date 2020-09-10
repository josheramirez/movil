<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moviles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('conductor_id')->nullable();
            $table->string('modelo_vehiculo')->nullable();
            $table->string('marca')->nullable();
            $table->integer('capacidad')->nullable();
            $table->string('patente')->nullable();

            $table->foreign('conductor_id')
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
        Schema::dropIfExists('moviles');
    }
}
