<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_projets', function (Blueprint $table) {
            $table->integer('id_contact');
            $table->integer('id_projet');
            
            $table->primary(['id_contact', 'id_projet']);
            $table->foreign('id_contact', 'contact_projets_ibfk_1')->references('id_contact')->on('contact');
            $table->foreign('id_projet', 'contact_projets_ibfk_2')->references('id_projet')->on('projets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_projets');
    }
}
