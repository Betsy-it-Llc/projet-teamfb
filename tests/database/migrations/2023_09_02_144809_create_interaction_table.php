<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteractionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('interaction', function (Blueprint $table) {
            $table->integer('id_interaction')->primary();
            $table->dateTime('date_heure')->nullable();
            $table->text('texte')->nullable();
            $table->string('type_interaction', 50)->nullable();
            $table->integer('id_contact')->nullable();
            $table->integer('id_experience')->nullable();
            
            $table->foreign('id_contact', 'interaction_ibfk_1')->references('id_contact')->on('contact');
            $table->foreign('id_experience', 'interaction_ibfk_2')->references('id_experience')->on('experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interaction');
    }
}
