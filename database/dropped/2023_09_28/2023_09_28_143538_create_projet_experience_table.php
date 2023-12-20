<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projet_experience', function (Blueprint $table) {
            $table->integer('id_experience');
            $table->integer('id_projet');
            
            $table->primary(['id_experience', 'id_projet']);
            $table->foreign('id_experience', 'projet_experience_ibfk_1')->references('id_experience')->on('experience');
            $table->foreign('id_projet', 'projet_experience_ibfk_2')->references('id_projet')->on('projets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projet_experience');
    }
}
