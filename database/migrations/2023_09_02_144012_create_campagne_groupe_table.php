<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampagneGroupeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('campagne_groupe', function (Blueprint $table) {
            $table->string('id_groupe')->nullable()->index('id_groupe');
            $table->unsignedBigInteger('id_campagne')->nullable()->index('id_campagne');
            $table->string('statut_publication', 45)->nullable();
            $table->string('statut_recherche', 45)->nullable();
            $table->string('traitement_publication', 45)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campagne_groupe');
    }
}
