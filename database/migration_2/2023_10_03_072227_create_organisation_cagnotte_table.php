<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisationCagnotteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation_cagnotte', function (Blueprint $table) {
            $table->integer('id_organisation');
            $table->integer('id_cagnotte');
            
            $table->primary(['id_organisation', 'id_cagnotte']);
            $table->foreign('id_organisation', 'organisation_cagnotte_ibfk_1')->references('id_organisation')->on('organisation');
            $table->foreign('id_cagnotte', 'organisation_cagnotte_ibfk_2')->references('id_cagnotte')->on('cagnottes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation_cagnotte');
    }
}
