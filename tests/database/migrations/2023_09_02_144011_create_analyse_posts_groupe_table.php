<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysePostsGroupeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('analyse_posts_groupe', function (Blueprint $table) {
            $table->string('id_post_groupe', 255);
            $table->integer('nb_likes')->nullable();
            $table->integer('nb_comments')->nullable();
            $table->integer('nb_shares')->nullable();
            $table->string('id_groupe', 255);
            $table->string('nom_posteur', 45)->nullable();
            $table->string('id_posteur', 255)->nullable();
            $table->dateTime('date_heure_postage')->nullable();
            $table->string('texte_post', 455)->nullable();
            $table->string('type_post', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analyse_posts_groupe');
    }
}
