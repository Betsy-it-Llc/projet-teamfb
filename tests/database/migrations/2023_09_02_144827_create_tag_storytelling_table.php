<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagStorytellingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('tag_storytelling', function (Blueprint $table) {
            $table->integer('id_storytelling');
            $table->integer('id_tag_story');
            
            $table->primary(['id_storytelling', 'id_tag_story']);
            $table->foreign('id_storytelling', 'tag_storytelling_ibfk_1')->references('id_storytelling')->on('storytelling');
            $table->foreign('id_tag_story', 'tag_storytelling_ibfk_2')->references('id_tag_story')->on('tag_story');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_storytelling');
    }
}
