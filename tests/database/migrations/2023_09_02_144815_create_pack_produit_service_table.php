<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackProduitServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('pack_produit_service', function (Blueprint $table) {
            $table->integer('id_pack');
            $table->integer('id_produit');
            $table->integer('quantity')->nullable();
            
            $table->primary(['id_pack', 'id_produit']);
            $table->foreign('id_pack', 'pack_produit_service_ibfk_1')->references('id_pack')->on('pack');
            $table->foreign('id_produit', 'pack_produit_service_ibfk_2')->references('id_produit')->on('produits_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pack_produit_service');
    }
}
