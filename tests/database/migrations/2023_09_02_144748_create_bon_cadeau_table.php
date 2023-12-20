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
        Schema::connection('mysql2')->create('bon_cadeau', function (Blueprint $table) {
            $table->integer('id_bonCadeau')->primary();
            $table->string('nom_destinataire', 100)->nullable();
            $table->string('titre', 100)->nullable();
            $table->text('message')->nullable();
            $table->string('url', 2048)->nullable();
            $table->integer('id_content_experience')->unique('id_content_experience');
            
            $table->foreign('id_content_experience', 'bon_cadeau_ibfk_1')->references('id_content_experience')->on('contents_experience');
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
