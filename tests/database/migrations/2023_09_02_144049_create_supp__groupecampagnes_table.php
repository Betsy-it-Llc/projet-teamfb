<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppGroupecampagnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('supp__groupecampagnes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_campagne');
            $table->string('nom')->nullable();
            $table->string('score')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->string('contexte')->nullable();
            $table->string('contenu_post_mere')->nullable();
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
        Schema::dropIfExists('supp__groupecampagnes');
    }
}
