<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('paiement', function (Blueprint $table) {
            $table->integer('id_paiment')->primary();
            $table->string('libelle', 50)->nullable();
            $table->double('prix')->nullable();
            $table->enum('statut_paiement', ['payé', 'non payé', 'non envoyé', 'echoué', 'annulé', 'demande confirmation', 'remboursé', 'brouillon', 'abandonné', ''])->nullable();
            $table->enum('moyen_paiement', ['espèce', 'carte bleu', 'virement', 'chèque'])->nullable();
            $table->dateTime('date_echeance')->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->enum('canal_paiement', ['stripe checkout', 'site web', 'app expérience', 'direct'])->nullable();
            $table->dateTime('date_update')->nullable();
            $table->integer('num_facture');
            $table->integer('id_contact')->nullable();
            $table->string('id_stripe_paiement', 50)->nullable();
            $table->string('url_stripe_paiement', 2048)->nullable();
            
            $table->foreign('num_facture', 'paiement_ibfk_1')->references('num_facture')->on('factures');
            $table->foreign('id_contact', 'paiement_ibfk_2')->references('id_contact')->on('contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiement');
    }
}
