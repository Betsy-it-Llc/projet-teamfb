<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegementationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('segementations', function (Blueprint $table) {
            $table->bigIncrements('id_segmentation')->index();
            $table->string('nom_segmentation')->nullable();
            $table->string('criteres')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('segementations');
    }
}
