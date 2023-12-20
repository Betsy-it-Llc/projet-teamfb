<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonCadeauTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_cadeau', function (Blueprint $table) {
            $table->integer('id_bonCadeau')->primary();
            $table->string('nom_destinataire', 50)->nullable();
            $table->string('titre', 50)->nullable();
            $table->string('message', 50)->nullable();
            $table->integer('id_experience');
            
            $table->foreign('id_experience', 'bon_cadeau_ibfk_1')->references('id_experience')->on('experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bon_cadeau');
    }
}
