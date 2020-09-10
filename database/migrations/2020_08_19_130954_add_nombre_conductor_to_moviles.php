<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNombreConductorToMoviles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moviles', function (Blueprint $table) {
            $table->string('nombre_conductor')->after('conductor_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('moviles', function (Blueprint $table) {
            $table->dropColumn('nombre_conductor');
        });
    }
}
