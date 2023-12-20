<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampagnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('campagnes', function (Blueprint $table) {
            $table->bigIncrements('id_campagne')->index();
            $table->string('nom')->nullable();
            $table->string('score')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->string('contexte')->nullable();
            $table->string('etat', 30)->nullable();
            $table->string('contenu_post_mere', 455)->nullable();
            $table->string('objectifs')->nullable();
            $table->string('recommandation')->nullable();
            $table->string('bilan')->nullable();
            $table->date('date_programmation')->nullable();
            $table->string('nb_likes')->nullable();
            $table->string('nb_comments')->nullable();
            $table->string('nb_shares')->nullable();
            $table->string('portee')->nullable();
            $table->string('id_segmentation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campagnes');
    }
}
