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
            $table->integer('montant_actuel')->nullable();
            $table->integer('id_categorie')->nullable();
            $table->integer('id_projet');
            $table->integer('id_statut_cagnotte')->nullable();
            
            $table->foreign('id_categorie', 'cagnottes_ibfk_1')->references('id_categorie')->on('categories');
            $table->foreign('id_projet', 'cagnottes_ibfk_2')->references('id_projet')->on('projets');
            $table->foreign('id_statut_cagnotte', 'cagnottes_ibfk_3')->references('id')->on('statuts_cagnottes');
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
