<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->integer('id_commentaire')->primary();
            $table->text('texte')->nullable();
            $table->date('date_creation')->nullable();
            $table->integer('likes')->nullable();
            $table->integer('dislikes')->nullable();
            $table->enum('statut', ['approuvé', 'en attente', 'refusé'])->nullable();
            $table->integer('id_commentaire_1')->nullable();
            $table->integer('id_experience');
            $table->integer('id_contact');
            
            $table->foreign('id_experience', 'commentaires_ibfk_2')->references('id_experience')->on('experience');
            $table->foreign('id_contact', 'commentaires_ibfk_3')->references('id_contact')->on('contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentaires');
    }
}
