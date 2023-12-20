<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorytellingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storytelling', function (Blueprint $table) {
            $table->integer('id_storytelling')->primary();
            $table->integer('id_content_experience')->unique('id_content_experience');
            $table->text('description')->nullable();
            $table->text('tags')->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_update')->nullable();
            
            $table->foreign('id_content_experience', 'storytelling_ibfk_1')->references('id_content_experience')->on('contents_experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storytelling');
    }
}
