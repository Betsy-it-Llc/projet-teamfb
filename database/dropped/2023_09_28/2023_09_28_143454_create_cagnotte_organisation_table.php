<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCagnotteOrganisationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cagnotte_organisation', function (Blueprint $table) {
            $table->integer('id_organisation');
            $table->integer('id_cagnotte');
            
            $table->primary(['id_organisation', 'id_cagnotte']);
            $table->foreign('id_organisation', 'cagnotte_organisation_ibfk_1')->references('id_organisation')->on('organisation');
            $table->foreign('id_cagnotte', 'cagnotte_organisation_ibfk_2')->references('id_cagnotte')->on('cagnottes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cagnotte_organisation');
    }
}
