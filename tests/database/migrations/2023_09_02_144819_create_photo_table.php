<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('photo', function (Blueprint $table) {
            $table->integer('id_photo')->primary();
            $table->string('description', 50)->nullable();
            $table->string('url', 2048)->nullable();
            $table->integer('id_content_experience')->unique('id_content_experience');
            
            $table->foreign('id_content_experience', 'photo_ibfk_1')->references('id_content_experience')->on('contents_experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo');
    }
}
