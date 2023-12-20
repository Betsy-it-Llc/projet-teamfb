<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureProduitServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_produit_service', function (Blueprint $table) {
            $table->integer('num_facture');
            $table->integer('id_produit');
            $table->integer('id_liste_prix');
            $table->integer('id_historique_remise')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('id_experience')->nullable();
            
            $table->primary(['num_facture', 'id_produit']);
            $table->foreign('num_facture', 'facture_produit_service_ibfk_1')->references('num_facture')->on('factures');
            $table->foreign('id_produit', 'facture_produit_service_ibfk_2')->references('id_produit')->on('produits_services');
            $table->foreign('id_experience', 'facture_produit_service_ibfk_3')->references('id_experience')->on('experience');
            $table->foreign('id_liste_prix', 'facture_produit_service_ibfk_4')->references('id_liste_prix')->on('liste_prix');
            $table->foreign('id_historique_remise', 'facture_produit_service_ibfk_5')->references('id_historique_remise')->on('historique_remise');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facture_produit_service');
    }
}
