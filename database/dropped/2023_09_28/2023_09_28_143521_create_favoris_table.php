<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoris', function (Blueprint $table) {
            $table->integer('id_favori')->primary();
            $table->integer('id_contact');
            $table->integer('id_cagnotte');
            
            $table->foreign('id_contact', 'favoris_ibfk_1')->references('id_contact')->on('contact');
            $table->foreign('id_cagnotte', 'favoris_ibfk_2')->references('id_cagnotte')->on('cagnottes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favoris');
    }
}
