<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostgroupesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('postgroupes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_post');
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postgroupes');
    }
}
