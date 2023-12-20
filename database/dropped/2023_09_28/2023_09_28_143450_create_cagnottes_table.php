<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCagnottesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cagnottes', function (Blueprint $table) {
            $table->integer('id_cagnotte')->primary();
            $table->string('titre', 200)->nullable();
            $table->text('description')->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_fin')->nullable();
            $table->double('objectif_montant')->nullable();
            $table->integer('montant_actuel')->nullable();
            $table->integer('id_experience');
            
            $table->foreign('id_experience', 'cagnottes_ibfk_1')->references('id_experience')->on('experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cagnottes');
    }
}
