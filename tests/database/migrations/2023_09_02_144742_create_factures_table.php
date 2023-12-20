<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('factures', function (Blueprint $table) {
            $table->integer('num_facture')->primary();
            $table->text('description_lib')->nullable();
            $table->double('prix_facture')->nullable();
            $table->string('statut_facture', 50)->nullable();
            $table->string('id_stripe', 50)->nullable();
            $table->string('url_facture', 2048)->nullable();
            $table->string('url_stripe', 2048)->nullable();
            $table->integer('nb_paiement')->nullable();
            $table->string('canal_reservation', 200)->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_update')->nullable();
            $table->integer('id_historique_remise')->nullable();
            
            $table->foreign('id_historique_remise', 'factures_ibfk1')->references('id_historique_remise')->on('historique_remise');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures');
    }
}
