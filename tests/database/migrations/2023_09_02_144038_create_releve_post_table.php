<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelevePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('releve_post', function (Blueprint $table) {
            $table->integer('id_releve_post')->primary();
            $table->date('date_releve')->nullable();
            $table->integer('nb_likes')->nullable();
            $table->integer('nb_comments')->nullable();
            $table->integer('nb_shares')->nullable();
            $table->integer('portee')->nullable();
            $table->integer('interaction')->nullable();
            $table->integer('clicks')->nullable();
            $table->integer('id_post');
            $table->integer('id_releve_campagne')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('releve_post');
    }
}
