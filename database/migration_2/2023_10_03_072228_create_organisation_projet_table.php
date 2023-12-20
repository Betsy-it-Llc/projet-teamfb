<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisationProjetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation_projet', function (Blueprint $table) {
            $table->integer('id_organisation');
            $table->integer('id_projet');
            
            $table->primary(['id_organisation', 'id_projet']);
            $table->foreign('id_organisation', 'organisation_projet_ibfk_1')->references('id_organisation')->on('organisation');
            $table->foreign('id_projet', 'organisation_projet_ibfk_2')->references('id_projet')->on('projets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation_projet');
    }
}
