<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMédiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('média', function (Blueprint $table) {
            $table->integer('id_media');
            $table->string('description', 50)->nullable();
            $table->string('type', 50)->nullable();
            $table->string('url', 50)->nullable();
            $table->integer('id_content_experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('média');
    }
}
