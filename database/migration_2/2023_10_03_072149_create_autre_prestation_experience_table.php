<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutrePrestationExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autre_prestation_experience', function (Blueprint $table) {
            $table->integer('id_produit');
            $table->integer('id_pack_experience');
            $table->integer('id_liste_prix')->nullable();
            $table->integer('id_historique_remise')->nullable();
            
            $table->primary(['id_produit', 'id_pack_experience']);
            $table->foreign('id_produit', 'autre_prestation_experience_ibfk_1')->references('id_produit')->on('produits_services');
            $table->foreign('id_pack_experience', 'autre_prestation_experience_ibfk_2')->references('id_pack_experience')->on('pack_experience');
            $table->foreign('id_liste_prix', 'autre_prestation_experience_ibfk_3')->references('id_liste_prix')->on('liste_prix');
            $table->foreign('id_historique_remise', 'autre_prestation_experience_ibfk_4')->references('id_historique_remise')->on('historique_remise');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autre_prestation_experience');
    }
}
