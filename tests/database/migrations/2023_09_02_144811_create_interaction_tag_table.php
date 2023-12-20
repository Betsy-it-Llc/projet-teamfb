<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteractionTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('interaction_tag', function (Blueprint $table) {
            $table->integer('id_interaction');
            $table->integer('id_tag_interaction');
            
            $table->primary(['id_interaction', 'id_tag_interaction']);
            $table->foreign('id_interaction', 'interaction_tag_ibfk_1')->references('id_interaction')->on('interaction');
            $table->foreign('id_tag_interaction', 'interaction_tag_ibfk_2')->references('id_tag_interaction')->on('tag_interaction');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interaction_tag');
    }
}
