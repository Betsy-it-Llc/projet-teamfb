<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->integer('id_projet')->primary();
            $table->string('nom', 200)->nullable();
            $table->text('description_courte')->nullable();
            $table->text('description_detaille')->nullable();
            $table->double('objectif_financier')->nullable();
            $table->text('info_contributeur')->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_fin')->nullable();
            $table->string('visibilite', 50)->nullable();
            $table->integer('id_type_projet')->nullable();
            $table->integer('id_statut_projet')->nullable();
            
            $table->foreign('id_type_projet', 'projets_ibfk_1')->references('id')->on('types_projets');
            $table->foreign('id_statut_projet', 'projets_ibfk_2')->references('id')->on('statuts_projets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projets');
    }
}
