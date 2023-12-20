<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributions', function (Blueprint $table) {
            $table->integer('id_contributions')->primary();
            $table->date('date_contribution')->nullable();
            $table->string('mode_paiement', 50)->nullable();
            $table->string('statut', 50)->nullable();
            $table->double('montant')->nullable();
            $table->integer('id_contact');
            $table->integer('id_cagnotte');
            
            $table->foreign('id_contact', 'contributions_ibfk_1')->references('id_contact')->on('contact');
            $table->foreign('id_cagnotte', 'contributions_ibfk_2')->references('id_cagnotte')->on('cagnottes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contributions');
    }
}
