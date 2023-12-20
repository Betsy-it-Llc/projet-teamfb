<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('experience', function (Blueprint $table) {
            $table->integer('id_experience')->primary();
            $table->string('numero_experience', 50);
            $table->string('nom_experience', 100)->nullable();
            $table->text('histoire_experience')->nullable();
            $table->string('url_experience_folder', 2048)->nullable();
            $table->date('date_reservation')->nullable();
            $table->time('heure_reservation')->nullable();
            $table->time('duree_reservation')->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_update')->nullable();
            $table->integer('id_produit')->nullable();
            $table->integer('id_pack')->nullable();
            
            $table->foreign('id_produit', 'experience_ibfk_1')->references('id_produit')->on('produits_services');
            $table->foreign('id_pack', 'experience_ibfk_2')->references('id_pack')->on('pack');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experience');
    }
}
