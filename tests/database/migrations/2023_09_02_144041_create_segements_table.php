<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('segements', function (Blueprint $table) {
            $table->bigIncrements('id_segment');
            $table->string('nom_segment')->nullable();
            $table->string('theme')->nullable();
            $table->string('type')->nullable();
            $table->string('caracteristique')->nullable();
            $table->string('description')->nullable();
            $table->string('nom_segmentation')->nullable()->index('id_segmentation');
            $table->string('nb_groupe')->nullable();
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
        Schema::dropIfExists('segements');
    }
}
