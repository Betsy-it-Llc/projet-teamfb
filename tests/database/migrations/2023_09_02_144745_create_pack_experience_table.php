<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('pack_experience', function (Blueprint $table) {
            $table->integer('id_pack_experience')->primary();
            $table->integer('nb_titres')->nullable();
            $table->integer('nb_participants')->nullable();
            $table->integer('id_pack');
            $table->integer('num_facture');
            $table->integer('id_experience')->nullable();
            $table->integer('id_liste_prix');
            $table->integer('id_historique_remise')->nullable();
            
            $table->foreign('id_pack', 'pack_experience_ibfk_1')->references('id_pack')->on('pack');
            $table->foreign('num_facture', 'pack_experience_ibfk_2')->references('num_facture')->on('factures');
            $table->foreign('id_experience', 'pack_experience_ibfk_3')->references('id_experience')->on('experience');
            $table->foreign('id_liste_prix', 'pack_experience_ibfk_4')->references('id_liste_prix')->on('liste_prix');
            $table->foreign('id_historique_remise', 'pack_experience_ibfk_5')->references('id_historique_remise')->on('historique_remise');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pack_experience');
    }
}
