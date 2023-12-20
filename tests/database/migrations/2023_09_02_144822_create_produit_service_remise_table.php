<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitServiceRemiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('produit_service_remise', function (Blueprint $table) {
            $table->integer('id_remise');
            $table->integer('id_produit');
            $table->double('taux')->nullable();
            $table->double('montant')->nullable();
            $table->integer('id_historique_remise')->nullable();
            
            $table->primary(['id_remise', 'id_produit']);
            $table->foreign('id_remise', 'produit_service_remise_ibfk_1')->references('id_remise')->on('remise');
            $table->foreign('id_produit', 'produit_service_remise_ibfk_2')->references('id_produit')->on('produits_services');
            $table->foreign('id_historique_remise', 'produit_service_remise_ibfk_3')->references('id_historique_remise')->on('historique_remise')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produit_service_remise');
    }
}
