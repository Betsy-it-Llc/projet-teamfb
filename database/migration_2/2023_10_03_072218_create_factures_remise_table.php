<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesRemiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures_remise', function (Blueprint $table) {
            $table->integer('num_facture');
            $table->integer('id_remise');
            $table->double('taux')->nullable();
            $table->double('montant')->nullable();
            
            $table->primary(['num_facture', 'id_remise']);
            $table->foreign('num_facture', 'factures_remise_ibfk_1')->references('num_facture')->on('factures');
            $table->foreign('id_remise', 'factures_remise_ibfk_2')->references('id_remise')->on('remise');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures_remise');
    }
}
