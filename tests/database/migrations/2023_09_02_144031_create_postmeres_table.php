<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostmeresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('postmeres', function (Blueprint $table) {
            $table->bigIncrements('id_post');
            $table->string('id_campagne')->nullable();
            $table->string('url_post')->nullable();
            $table->string('statut_scrappe')->nullable();
            $table->string('titre')->nullable();
            $table->string('type_media')->nullable();
            $table->string('legende')->nullable();
            $table->string('hashtag')->nullable();
            $table->string('portee')->nullable();
            $table->string('interaction')->nullable();
            $table->timestamps();
            $table->string('Compte_Emetteur')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postmeres');
    }
}
