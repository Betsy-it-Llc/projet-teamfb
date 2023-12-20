<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->integer('id_persona')->primary();
            $table->string('tag', 200)->nullable();
            $table->text('avatar')->nullable();
            $table->text('description_generale')->nullable();
            $table->integer('age')->nullable();
            $table->string('genre', 100)->nullable();
            $table->text('niveau_education')->nullable();
            $table->string('situation_familiale', 200)->nullable();
            $table->text('profession')->nullable();
            $table->text('geographie')->nullable();
            $table->double('revenu')->nullable();
            $table->text('objectifs_principaux')->nullable();
            $table->text('defis')->nullable();
            $table->text('methode_achat')->nullable();
            $table->text('facteurs_decision')->nullable();
            $table->text('frequence_achat')->nullable();
            $table->text('media_prefere')->nullable();
            $table->text('centres_interet')->nullable();
            $table->text('marques_produits_preferes')->nullable();
            $table->text('citations_fictives')->nullable();
            $table->text('objections_potentielles')->nullable();
            $table->text('solution_proposee')->nullable();
            $table->text('motivations_achat')->nullable();
            $table->text('canal_acquisition')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
}
