<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('questionads', function (Blueprint $table) {
            $table->id();
            $table->string('id_groupe')->nullable();
            $table->string('nom')->nullable();
            $table->string('theme')->nullable();
            $table->string('nb_membres')->nullable();
            $table->string('id_question')->nullable();
            $table->string('question', 2000)->nullable();
            $table->string('reponse')->nullable();
            $table->string('reponse2')->nullable();
            $table->string('reponse3')->nullable();
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
        Schema::dropIfExists('questionads');
    }
}
