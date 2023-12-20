<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceStatutNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('experience_statut_notification', function (Blueprint $table) {
            $table->integer('id_notification')->primary();
            $table->dateTime('date_statut')->nullable();
            $table->integer('id_experience');
            $table->integer('id_statut_experience');
            
            $table->foreign('id_notification', 'experience_statut_notification_ibfk_1')->references('id_notification')->on('notification');
            $table->foreign('id_experience', 'experience_statut_notification_ibfk_2')->references('id_experience')->on('experience');
            $table->foreign('id_statut_experience', 'experience_statut_notification_ibfk_3')->references('id_statut_experience')->on('experience_statut');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experience_statut_notification');
    }
}
