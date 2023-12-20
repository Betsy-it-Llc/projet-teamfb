<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListePrixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liste_prix', function (Blueprint $table) {
            $table->integer('id_liste_prix')->primary();
            $table->decimal('prix', 15, 2)->nullable();
            $table->string('statut', 50)->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->integer('id_pack')->nullable();
            $table->integer('id_produit')->nullable();
            
            $table->foreign('id_pack', 'liste_prix_ibfk_1')->references('id_pack')->on('pack');
            $table->foreign('id_produit', 'liste_prix_ibfk_2')->references('id_produit')->on('produits_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liste_prix');
    }
}
