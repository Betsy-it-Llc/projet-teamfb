<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactJeuxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('contact_jeux', function (Blueprint $table) {
            $table->integer('id_contact');
            $table->integer('id_jeux');
            
            $table->primary(['id_contact', 'id_jeux']);
            $table->foreign('id_contact', 'contact_jeux_ibfk_1')->references('id_contact')->on('contact');
            $table->foreign('id_jeux', 'contact_jeux_ibfk_2')->references('id_jeux')->on('jeux_concours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_jeux');
    }
}
