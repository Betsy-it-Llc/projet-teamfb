<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql3')->create('notification', function (Blueprint $table) {
            $table->integer('id_notification')->primary();
            $table->string('date', 50);
            $table->string('heure', 50);
            $table->string('automation', 50);
            $table->enum('statut', ['succès', 'erreur']);
            $table->text('message');
            $table->text('url_workflow');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification');
    }
}
