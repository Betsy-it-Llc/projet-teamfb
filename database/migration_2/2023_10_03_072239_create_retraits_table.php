<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetraitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retraits', function (Blueprint $table) {
            $table->integer('id_retrait')->primary();
            $table->double('montant')->nullable();
            $table->dateTime('date_demande')->nullable();
            $table->string('statut', 50)->nullable();
            $table->integer('id_cagnotte');
            
            $table->foreign('id_cagnotte', 'retraits_ibfk_1')->references('id_cagnotte')->on('cagnottes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retraits');
    }
}
