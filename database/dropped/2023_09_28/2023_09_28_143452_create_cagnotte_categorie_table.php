<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCagnotteCategorieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cagnotte_categorie', function (Blueprint $table) {
            $table->integer('id_cagnotte');
            $table->integer('id_cagnotte_categorie');
            
            $table->primary(['id_cagnotte', 'id_cagnotte_categorie']);
            $table->foreign('id_cagnotte', 'cagnotte_categorie_ibfk_1')->references('id_cagnotte')->on('cagnottes');
            $table->foreign('id_cagnotte_categorie', 'cagnotte_categorie_ibfk_2')->references('id_cagnotte_categorie')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cagnotte_categorie');
    }
}
