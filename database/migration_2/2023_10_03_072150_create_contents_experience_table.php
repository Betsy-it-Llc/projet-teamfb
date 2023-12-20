<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents_experience', function (Blueprint $table) {
            $table->integer('id_content_experience')->primary();
            $table->dateTime('date_heure')->nullable();
            $table->dateTime('date_update')->nullable();
            $table->text('description_')->nullable();
            $table->string('type', 50)->nullable();
            $table->integer('id_experience');
            
            $table->foreign('id_experience', 'contents_experience_ibfk_1')->references('id_experience')->on('experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents_experience');
    }
}
