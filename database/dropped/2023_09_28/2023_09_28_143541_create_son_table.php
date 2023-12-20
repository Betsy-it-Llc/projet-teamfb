<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('son', function (Blueprint $table) {
            $table->integer('id_son')->primary();
            $table->string('description', 50)->nullable();
            $table->string('url', 2048)->nullable();
            $table->integer('id_content_experience')->unique('id_content_experience');
            
            $table->foreign('id_content_experience', 'son_ibfk_1')->references('id_content_experience')->on('contents_experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('son');
    }
}
