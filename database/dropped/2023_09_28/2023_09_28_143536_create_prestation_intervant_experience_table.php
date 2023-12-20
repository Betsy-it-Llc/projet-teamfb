<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestationIntervantExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestation_intervant_experience', function (Blueprint $table) {
            $table->integer('id_experience');
            $table->integer('id_prestation_intervenant');
            
            $table->primary(['id_experience', 'id_prestation_intervenant']);
            $table->foreign('id_experience', 'prestation_intervant_experience_ibfk_1')->references('id_experience')->on('experience');
            $table->foreign('id_prestation_intervenant', 'prestation_intervant_experience_ibfk_2')->references('id_prestation_intervenant')->on('prestation_intervenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestation_intervant_experience');
    }
}
