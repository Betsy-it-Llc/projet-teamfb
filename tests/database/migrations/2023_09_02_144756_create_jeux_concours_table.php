<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJeuxConcoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('jeux_concours', function (Blueprint $table) {
            $table->integer('id_jeux')->primary();
            $table->string('nom_jeu', 50)->nullable();
            $table->dateTime('date_début')->nullable();
            $table->dateTime('date_fin')->nullable();
            $table->integer('id_remise');
            
            $table->foreign('id_remise', 'jeux_concours_ibfk_1')->references('id_remise')->on('remise');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jeux_concours');
    }
}
