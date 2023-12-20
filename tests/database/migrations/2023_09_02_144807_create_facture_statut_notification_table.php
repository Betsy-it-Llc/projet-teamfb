<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureStatutNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('facture_statut_notification', function (Blueprint $table) {
            $table->integer('id_notification')->primary();
            $table->dateTime('date_statut')->nullable();
            $table->integer('num_facture');
            $table->integer('id_facture_statut');
            
            $table->foreign('id_notification', 'facture_statut_notification_ibfk_1')->references('id_notification')->on('notification');
            $table->foreign('num_facture', 'facture_statut_notification_ibfk_2')->references('num_facture')->on('factures');
            $table->foreign('id_facture_statut', 'facture_statut_notification_ibfk_3')->references('id_facture_statut')->on('facture_statut');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facture_statut_notification');
    }
}
