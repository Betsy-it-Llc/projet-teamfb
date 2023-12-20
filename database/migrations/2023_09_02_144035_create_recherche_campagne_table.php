<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRechercheCampagneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('recherche_campagne', function (Blueprint $table) {
            $table->integer('id_recherche_campagne');
            $table->integer('id_campagne');
            $table->string('statut_recherche', 45)->nullable();
            $table->dateTime('date_recherche')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recherche_campagne');
    }
}
