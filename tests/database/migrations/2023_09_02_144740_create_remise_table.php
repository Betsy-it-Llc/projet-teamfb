<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('remise', function (Blueprint $table) {
            $table->integer('id_remise')->primary();
            $table->string('nom_remise', 50)->nullable();
            $table->string('type_remise', 50)->nullable();
            $table->double('taux')->nullable();
            $table->double('montant')->nullable();
            $table->dateTime('date_debut')->nullable();
            $table->dateTime('date_fin')->nullable();
            $table->text('description')->nullable();
            $table->enum('statut', ['actif', 'inactif']);
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_update')->nullable();
            $table->string('id_stripe_remise', 50)->nullable();
            $table->string('url_stripe_remise', 2048)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('remise');
    }
}
