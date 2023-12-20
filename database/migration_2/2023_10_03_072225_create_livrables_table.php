<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivrablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livrables', function (Blueprint $table) {
            $table->integer('id_livrable_')->primary();
            $table->string('nom', 50)->nullable();
            $table->string('type', 50)->nullable();
            $table->dateTime('date_envoie')->nullable();
            $table->string('url', 2048)->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_update')->nullable();
            $table->integer('id_content_experience')->unique('id_content_experience');
            
            $table->foreign('id_content_experience', 'livrables_ibfk_1')->references('id_content_experience')->on('contents_experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livrables');
    }
}
