<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriqueRemiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('historique_remise', function (Blueprint $table) {
            $table->integer('id_historique_remise')->primary();
            $table->dateTime('date_creation')->nullable();
            $table->decimal('montant', 15, 2)->nullable();
            $table->decimal('taux', 15, 2)->nullable();
            $table->integer('id_remise')->nullable();
            
            $table->foreign('id_remise', 'historique_remise_ibfk_1')->references('id_remise')->on('remise');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historique_remise');
    }
}
