<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvenementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evenement', function (Blueprint $table) {
            $table->integer('id_evenement')->primary();
            $table->enum('type_evenement', ['prise de contact', 'speetch experience', ' interaction (pré experience'])->nullable();
            $table->dateTime('date_evenement')->nullable();
            $table->integer('id_experience');
            
            $table->foreign('id_experience', 'evenement_ibfk_1')->references('id_experience')->on('experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evenement');
    }
}
