<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits_services', function (Blueprint $table) {
            $table->integer('id_produit')->primary();
            $table->text('abstract')->nullable();
            $table->text('description')->nullable();
            $table->string('categorie', 50)->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_update')->nullable();
            $table->string('statut', 50)->nullable();
            $table->string('nom_produit', 50)->nullable();
            $table->string('prix', 50)->nullable();
            $table->integer('stock')->nullable();
            $table->string('id_stripe_produit', 50)->nullable();
            $table->string('url_stripe_produit', 2048)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits_services');
    }
}
