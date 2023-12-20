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
        Schema::connection('mysql2')->create('média', function (Blueprint $table) {
            $table->integer('id_media')->primary();
            $table->string('type', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('url', 50)->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_update')->nullable();
            $table->integer('id_content_experience')->unique('id_content_experience');
            
            $table->foreign('id_content_experience', 'média_ibfk_1')->references('id_content_experience')->on('contents_experience');
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
