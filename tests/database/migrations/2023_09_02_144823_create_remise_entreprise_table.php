<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemiseEntrepriseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('remise_entreprise', function (Blueprint $table) {
            $table->integer('id_remise');
            $table->integer('id_organisation');
            
            $table->primary(['id_remise', 'id_organisation']);
            $table->foreign('id_remise', 'remise_entreprise_ibfk_1')->references('id_remise')->on('remise');
            $table->foreign('id_organisation', 'remise_entreprise_ibfk_2')->references('id_organisation')->on('organisation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('remise_entreprise');
    }
}
