<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoYoutubeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_youtube', function (Blueprint $table) {
            $table->integer('id_video_youtube')->primary();
            $table->text('titre')->nullable();
            $table->string('categorie', 50)->nullable();
            $table->string('url_source', 2048)->nullable();
            $table->string('visibilite', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('playlist', 50)->nullable();
            $table->string('tags', 50)->nullable();
            $table->string('url_youtube', 50)->nullable();
            $table->dateTime('date_enregistrement')->nullable();
            $table->dateTime('date_publication')->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_modification')->nullable();
            $table->integer('id_content_experience')->unique('id_content_experience');
            
            $table->foreign('id_content_experience', 'video_youtube_ibfk_1')->references('id_content_experience')->on('contents_experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_youtube');
    }
}
